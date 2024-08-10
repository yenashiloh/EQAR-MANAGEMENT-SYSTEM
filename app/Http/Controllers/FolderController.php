<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Mail;
use App\Models\AdminAccount;
use App\Models\FacultyAccount;
use App\Models\YearSemestralFolder;
use App\Models\ProgramFolder;
use App\Models\FolderName;
use App\Models\ClassList;

class FolderController extends Controller
{
    public function getFacultyDetails()
    {
        if (Auth::check()) {
            $faculty = Auth::user();
            $personalDetails = $faculty->personalDetails;
            $email = $faculty->email;
            return [
                'first_name' => $personalDetails->first_name,
                'middle_name' => $personalDetails->middle_name,
                'last_name' => $personalDetails->last_name,
                'email' => $email,
                'birthday' => $personalDetails->birthday,
                'sex' => $personalDetails->sex,
                'department' => $personalDetails->department,
                'id_number' => $personalDetails->id_number,
                'employee_type' => $personalDetails->employee_type,
                'phone_number' => $personalDetails->phone_number,
            ];
        }
        return null;
    }

    public function viewFolderFaculty($year_semestral_id)
    {
        if (!auth()->check()) {
            return redirect()->route('faculty-login');
        }
        
        $facultyDetails = $this->getFacultyDetails();
        $folder = YearSemestralFolder::find($year_semestral_id);
    
        $folderName = $folder->folderName->folder_name;
    
        $programFolders = ProgramFolder::with('admin')
            ->where('year_semestral_id', $year_semestral_id)
            ->get();
    
        $programFolderId = request()->input('program_folder_id');
        $programFolder = ProgramFolder::find($programFolderId);
    
        return view('faculty.accomplishments.folders.view-folders', [
            'folder' => $folder, 
            'facultyDetails' =>  $facultyDetails,
            'year_semestral_id' => $year_semestral_id,
            'programFolders' => $programFolders,
            'programFolder' => $programFolder,
            'folderName' => $folderName 
        ]);
    }

    public function viewAllFiles($id)
    {
        if (!auth()->check()) {
            return redirect()->route('faculty-login');
        }
    
        $facultyDetails = $this->getFacultyDetails();
    
        $programFolder = ProgramFolder::find($id);
    
        if (!$programFolder) {
            return redirect()->route('folder-not-found');
        }
    
        $folderName = 'Unknown';
        if ($programFolder) {
            $folderNameRecord = \App\Models\FolderName::find($programFolder->folder_name_id);
            $folderName = $folderNameRecord ? $folderNameRecord->folder_name : 'Unknown';
        }
    
        $files = \App\Models\ProgramFolder::where('program_folder_id', $id)->get();
    
        $classLists = \App\Models\ClassList::where('program_folder_id', $id)->get();
    
        return view('faculty.accomplishments.folders.all-uploaded-file', [
            'files' => $files,
            'program_folder_id' => $id, 
            'facultyDetails' => $facultyDetails,
            'folderName' => $folderName,
            'folder' => $programFolder,
            'classLists' => $classLists, 
        ]);
    }
    
    public function destroy($id)
    {
        $folder = ClassList::find($id);
        
        if ($folder) {
            $folder->delete();
            return response()->json(['success' => true, 'message' => 'Folder deleted successfully.']);
        }
        
        return response()->json(['success' => false, 'message' => 'Folder not found.'], 404);
    }

    public function show($id)
    {
        $classList = ClassList::findOrFail($id);
        return response()->json($classList);
    }

    public function edit($id)
    {
        if (!auth()->check()) {
            return redirect()->route('faculty-login');
        }
    
        $facultyDetails = $this->getFacultyDetails();
        $accomplishment = \App\Models\ClassList::find($id);
        
        if (!$accomplishment) {
            return redirect()->route('folder-not-found');
        }
    
        return view('faculty.accomplishments.folders.edit-file', [
            'accomplishment' => $accomplishment,
            'facultyDetails' =>  $facultyDetails,
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'reporting_to' => 'required|string',
            'department' => 'required|string',
            'collegeCampus' => 'nullable|string',
            'courseTitle' => 'required|string',
            'courseCode' => 'required|string',
            'assignedTask' => 'required|string',
            'dateFinished' => 'required|date',
            'supportingDocuments' => 'nullable|string',
            'fileUpload' => 'nullable|file|max:51200',
            'notes' => 'nullable|string',
        ]);

        $accomplishment = ClassList::findOrFail($id);
        $filePath = $accomplishment->fileUpload;

        if ($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');
            $filePath = $file->store('uploads', 'public');
        }

        $accomplishment->update([
            'reporting_to' => $request->input('reporting_to'),
            'department' => $request->input('department'),
            'collegeCampus' => $request->input('collegeCampus'),
            'courseTitle' => $request->input('courseTitle'),
            'courseCode' => $request->input('courseCode'),
            'assignedTask' => $request->input('assignedTask'),
            'dateFinished' => $request->input('dateFinished'),
            'supportingDocuments' => $request->input('supportingDocuments'),
            'fileUpload' => $filePath,
            'notes' => $request->input('notes'),
        ]);
        session()->flash('success', 'Updated successfully!');
        
        return response()->json([
            'success' => true,
            'redirect' => route('faculty.accomplishments.folders.all-uploaded-file', [$accomplishment->program_folder_id]),
            'message' => 'Updated successfully!',
        ]);
        
        
    }


    

}
