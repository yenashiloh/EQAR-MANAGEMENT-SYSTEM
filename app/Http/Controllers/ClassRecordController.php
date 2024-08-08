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

class ClassRecordController extends Controller
{

    //store class record folder
    public function storeYearSemestralFolder(Request $request, $folder_name_id)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);
    
        if (!FolderName::find($folder_name_id)) {
            return redirect()->back()->with('error', 'Folder Name ID not found.');
        }
    
        $folder = new YearSemestralFolder();
        $folder->folder_name = $request->folder_name;
        $folder->folder_name_id = $folder_name_id; 
        $folder->admin_id = auth()->guard('admin')->id();
        $folder->save();
    
        return redirect()->route('admin.accomplishment.class-records.year-semestral', ['folder_name_id' => $folder_name_id])
            ->with('success', 'Folder added successfully!');
    }
    
    //show view-folder page
    public function viewFolder($year_semestral_id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin-login');
        }
    
        $adminId = auth()->guard('admin')->id();
        $admin = AdminAccount::find($adminId);
        
        $adminName = $admin->name;
        $folder = YearSemestralFolder::find($year_semestral_id);
    
        if (!$folder) {
            return redirect()->route('admin.accomplishments.class-records.index')->with('error', 'Folder not found.');
        }
    
        $folderName = $folder->folderName->folder_name;
    
        $programFolders = ProgramFolder::with('admin')
            ->where('year_semestral_id', $year_semestral_id)
            ->get();
    
        $programFolderId = request()->input('program_folder_id');
        $programFolder = ProgramFolder::find($programFolderId);
    
        return view('admin.accomplishments.class-records.view-folders', [
            'folder' => $folder, 
            'adminName' => $adminName,
            'year_semestral_id' => $year_semestral_id,
            'programFolders' => $programFolders,
            'programFolder' => $programFolder,
            'folderName' => $folderName 
        ]);
    }
    
    //edit Main Folder
    public function editFolder(Request $request, $id)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);
    
        $folder = YearSemestralFolder::find($id);
        $folder->folder_name = $request->folder_name;
        $folder->save();
    
        return redirect()->route('admin.accomplishment.class-records.year-semestral', ['folder_name_id' => $folder->folder_name_id])
            ->with('success', 'Folder updated successfully!');
    }
    
    //delete Main Folder
    public function deleteFolder($year_semestral_id)
    {
        $folder = YearSemestralFolder::find($year_semestral_id);
        $folder->delete();

        return redirect()->route('admin.accomplishment.class-records.year-semestral', ['folder_name_id' => $folder->folder_name_id])
            ->with('success', 'Folder deleted successfully!');
    }

    //store the program folder
    public function storeProgramFolder(Request $request, $id)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);
    
        $folder = new ProgramFolder();
        $folder->folder_name = $request->folder_name;
        $folder->year_semestral_id = $id; 
        $folder->admin_id = auth()->guard('admin')->id();
        $folder->save();
    
        return redirect()->route('admin.accomplishments.class-records.view-folders', ['id' => $id])
            ->with('success', 'Folder added successfully!');
    }
    
    //edit program folder
    public function editProgramFolder(Request $request, $program_folder_id)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
        ]);
    
        $folder = ProgramFolder::findOrFail($program_folder_id);
        $folder->folder_name = $request->folder_name;
        $folder->save();
    
        $yearSemestralId = $folder->year_semestral_id;

        return redirect()->route('admin.accomplishments.class-records.view-folders', ['id' => $yearSemestralId])
            ->with('success', 'Folder updated successfully!');
    }
    
    //delete program folder
    public function deleteProgramFolder($id)
    {
        $folder = ProgramFolder::find($id);
        if ($folder) {
            $folder->delete();
            return response()->json(['success' => 'Folder deleted successfully!']);
        } else {
            return response()->json(['error' => 'Folder not found.'], 404);
        }
    }
    
    public function yearSemestral()
    {
        return $this->belongsTo(YearSemestralFolder::class, 'year_semestral_id', 'year_semestral_id');
    }

    //view all files page
    public function viewAllFiles($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin-login');
        }
    
        $adminId = auth()->guard('admin')->id();
        $admin = \App\Models\AdminAccount::find($adminId);
        $adminName = $admin->name;
    
        $files = \App\Models\ProgramFolder::where('program_folder_id', $id)->get(); 
    
        $folder = \App\Models\FolderName::find($id); 
        $folderName = $folder ? $folder->main_folder_name : 'Unknown Folder'; 
    
        // Retrieve class lists
        $classLists = \App\Models\ClassList::where('program_folder_id', $id)->get();
    
        // Retrieve employee details
        $employeeDetails = \App\Models\FacultyPersonalDetails::whereIn('faculty_account_id', $classLists->pluck('faculty_account_id'))->get()->keyBy('faculty_account_id');
    
        return view('admin.accomplishments.class-records.all-uploaded-file', [
            'files' => $files,
            'adminName' => $adminName,
            'programFolderId' => $id,
            'folderName' => $folderName,
            'classLists' => $classLists,
            'employeeDetails' => $employeeDetails
        ]);
    }
}
