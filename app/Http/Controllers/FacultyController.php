<?php

namespace App\Http\Controllers;
use App\Models\ClassRecord;
use App\Models\ClassList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacultyController extends Controller
{

    //show accomplishment page
    public function accomplishmentPage ()
    {
        return view ('faculty.faculty-accomplishment');
    }

    //show class record
    public function classRecordsPage()
    {
        return view('faculty.accomplishments.faculty-class-records');
    }

    //show add accomplishment page
    public function addAccomplishmentPage()
    {
        return view('faculty.accomplishments.faculty-add-accomplishment');
    }

    //store the data
    protected function storeAccomplishmentBase(Request $request, $modelClass, $redirectRoute)
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
            'fileUpload' => 'required|file',
            'notes' => 'nullable|string',
        ]);

        $filePath = null;
        if ($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');
            $filePath = $file->store('uploads', 'public');
        }

        $modelClass::create([
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

        return redirect()->route($redirectRoute)->with('success', 'Form submitted successfully!');
    }

    //store class record
    public function storeClassRecord(Request $request)
    {
        try {
            $result = $this->storeAccomplishmentBase($request, \App\Models\ClassRecord::class, 'faculty.accomplishments.faculty-class-records');

            if ($request->ajax()) {
                return response()->json([
                    'success' => true, 
                    'redirect' => route('faculty.accomplishments.faculty-class-records', ['success' => 'Submitted successfully!'])
                ]);
            }

            return redirect()->route('faculty.accomplishments.faculty-class-records', ['success' => 'Submitted successfully!']);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while saving the class record.'
                ], 500);
            }

            return back()->with('error', 'An error occurred while saving the class record.');
        }
    }

    //show class list page
    public function classListPage(Request $request)
    {
        $successMessage = $request->query('success');
        $classLists = ClassList::all();
    
        foreach ($classLists as $classList) {
            $classList->dateFinished = \Carbon\Carbon::parse($classList->dateFinished);
        }
    
        return view('faculty.accomplishments.faculty-class-list', [
            'successMessage' => $successMessage,
            'classLists' => $classLists,
        ]);
    }
    
    
    //show class list form page
    public function addClassListFormPage()
    {
        return view('faculty.accomplishments.faculty-add-class-list');
    }

    //store data class list
    public function storeClassList(Request $request)
    {
        try {
            $result = $this->storeAccomplishmentBase($request, \App\Models\ClassList::class, 'faculty.accomplishments.faculty-class-list');
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => true, 
                    'redirect' => route('faculty.accomplishments.faculty-class-list', ['success' => 'Submitted successfully!'])
                ]);
            }
    
            return redirect()->route('faculty.accomplishments.faculty-class-list', ['success' => 'Submitted successfully!']);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while saving the class list.'
                ], 500);
            }
    
            return back()->with('error', 'An error occurred while saving the class list.');
        }
    }
    
}
