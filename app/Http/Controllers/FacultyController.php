<?php

namespace App\Http\Controllers;
use App\Models\ClassRecord;
use App\Models\ClassList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\FacultyAccount;
use App\Models\FacultyPersonalDetails;
use App\Models\YearSemestralFolder;
use App\Models\ProgramFolder;
use App\Models\FolderName;



class FacultyController extends Controller
{
    //get the faculty details
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
    
    //show role page
    public function showRolePage()
    {
        return view('role');
    }

    //show login page
    public function showLoginPage()
    {
        return view('faculty-login');
    }

    //post login
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::guard('web')->attempt($credentials)) {
            $faculty = Auth::guard('web')->user();    
    
            if ($faculty instanceof FacultyAccount) {
                Log::debug('User is a faculty');
    
                if (!$faculty->verify_status) {
                    Auth::guard('web')->logout();
                    return redirect(route('faculty-login'))->with("error", "Your email is not verified. Please verify your email before logging in.");
                }
    
                if ($faculty->verification_code) {
                    Auth::guard('web')->logout();
                    return redirect(route('faculty-login'))->with("error", "Your account is not verified. Please verify your email before logging in.");
                }
            }
    
            Log::debug('Login successful');
            return redirect()->intended(route('faculty.faculty-accomplishment')); 
        }
    
        return redirect(route('faculty-login'))->with("error", "Incorrect email address or password. Please try again.");
    }
    
    //show sign up page
    public function showSignUpPage()
    {
        return view('faculty-sign-up');
    }

    //show verification page
    public function showVerificationPage()
    {
        return view('verification.verification');
    }

    //show otp verification form
    public function showOtpVerificationForm()
    {
        return view('otp-verification');
    }

    //show verified check
    public function showVerifiedCheck()
    {
        return view('verified');
    }

    //verification otp
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:faculty_account,email',
            'otp' => 'required|digits:6',
        ]);

        $faculty = FacultyAccount::where('email', $request->email)
                                ->where('verification_code', $request->otp)
                                ->first();

        if (!$faculty) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors(['otp' => 'The provided OTP is invalid.']);
        }

        $faculty->email_verified_at = now();
        $faculty->verify_status = true;
        $faculty->verification_code = null;
        $faculty->save();

        return redirect()->route('verified');
    }

     //resed otp
     public function resendOtp(Request $request)
     {
         $request->validate([
             'email' => 'required|email|exists:faculty_account,email',
         ]);
 
         $faculty = FacultyAccount::where('email', $request->email)->first();
 
         $newOtp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
 
         $faculty->verification_code = $newOtp;
         $faculty->save();
 
         Mail::send('emails.otp', ['otp' => $newOtp], function($message) use ($request) {
             $message->to($request->email);
             $message->subject('Verification OTP');
             $message->from('facultymanagement@gmail.com', 'FARM System');
         });
 
         return redirect()->back()->with('message', 'A new OTP has been sent to your email.')
                                 ->withInput(['email' => $request->email]);
     }
 
    //sign up POST
    public function signUpPost(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:faculty_account,email',
            'birthday' => 'required|date',
            'sex' => 'required|in:Male,Female', 
            'department' => 'required|string|max:255',
            'id_number' => 'required|string|max:255',
            'employee_type' => 'required|in:Part Time,Regular',
            'phone_number' => 'required|string|max:11',
            'password' => 'required|min:8|confirmed', 
        ]);

        $otp = rand(100000, 999999); 

        $facultyData = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(80), 
            'email_verified_at' => null,
            'verify_status' => false,
            'verification_code' => $otp,
        ];

        $faculty = FacultyAccount::create($facultyData);

        $personalDetailsData = $request->only([
            'first_name',
            'middle_name',
            'last_name',
            'birthday',
            'sex',
            'department',
            'id_number',
            'employee_type',
            'phone_number',
        ]);

        $personalDetailsData['faculty_account_id'] = $faculty->faculty_account_id;
        FacultyPersonalDetails::create($personalDetailsData);

        Mail::send('emails.otp', ['otp' => $otp], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Verification OTP');
            $message->from('facultymanagement@gmail.com', 'FARM System'); 
        });

        Log::info('Registration successful for:', $personalDetailsData);

        return redirect()->route('otp-verification')->with('email', $request->email);
    }

    //show accomplishment page
    public function accomplishmentPage ()
    {
        if (!auth()->check()) {
            return redirect()->route('faculty-login');
        }

        $folders = FolderName::all();

        $facultyDetails = $this->getFacultyDetails();
        return view('faculty.faculty-accomplishment', compact('folders', 'facultyDetails'));

        return view('faculty.faculty-accomplishment', [
            'facultyDetails' =>  $facultyDetails,
            'folders' => $folders
        ]);
    }

    //show year semestral folder page
    public function showYearSemestralFolder($folder_name_id)
    {
        if (!auth()->check()) {
            return redirect()->route('faculty-login');
        }
    
        $facultyDetails = $this->getFacultyDetails();
        $folder = \App\Models\FolderName::find($folder_name_id);
        $folders = \App\Models\YearSemestralFolder::where('folder_name_id', $folder_name_id)->get();
    
        return view('faculty.accomplishments.folders.year-semestral', [
            'folder_name_id' => $folder_name_id,
            'folder' => $folder, 
            'folders' => $folders,
            'folderName' => $folder->folder_name,
            'facultyDetails' =>  $facultyDetails
        ]);
    }
    
    //show class record page
    public function classRecordsPage()
    {
        return view('faculty.accomplishments.faculty-class-records');
    }

    //show add accomplishment page
    public function addAccomplishmentPage($program_folder_id)
    {
        if (!auth()->check()) {
            return redirect()->route('faculty-login');
        }
    
        $facultyDetails = $this->getFacultyDetails();
        return view('faculty.accomplishments.folders.add-accomplishment', [
            'program_folder_id' => $program_folder_id,
            'facultyDetails' =>  $facultyDetails
        ]);
    }

    //store the data
    protected function storeAccomplishmentBase(Request $request, $modelClass, $redirectRoute, $program_folder_id, $faculty_account_id)
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
           'fileUpload' => 'required|file|max:51200',
            'notes' => 'nullable|string',
        ]);
    
        $filePath = null;
        if ($request->hasFile('fileUpload')) {
            $file = $request->file('fileUpload');
            $filePath = $file->store('uploads', 'public');
        }
    
        $modelClass::create([
            'program_folder_id' => $program_folder_id,
            'faculty_account_id' => $faculty_account_id,
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
    
        return redirect()->route($redirectRoute)->with('success', 'Submitted successfully!');
    }
    //store class record
    public function storeAccomplishment(Request $request, $program_folder_id)
    {
        try {
            \Log::info('Program Folder ID: ' . $program_folder_id);

            $result = $this->storeAccomplishmentBase($request, \App\Models\ClassRecord::class, 'faculty.accomplishments.store-accomplishment', $program_folder_id);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'redirect' => route('faculty.accomplishments.folders.all-uploaded-file', [
                        'program_folder_id' => $program_folder_id,
                        'success' => 'Submitted successfully!'
                    ])
                ]);
            }

            return redirect()->route('faculty.accomplishments.folders.all-uploaded-file', [
                'program_folder_id' => $program_folder_id
            ])->with('success', 'Submitted successfully!');
            

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

    public function storeClassList(Request $request, $program_folder_id)
    {
        try {
            if (!auth()->check()) {
                return redirect()->route('faculty-login');
            }
    
            $faculty_account_id = auth()->user()->faculty_account_id;
    
            $result = $this->storeAccomplishmentBase(
                $request,
                \App\Models\ClassList::class,
                'faculty.accomplishments.faculty-class-list',
                $program_folder_id,
                $faculty_account_id
            );
    
            $redirectUrl = route('faculty.accomplishments.folders.all-uploaded-file', [
                'id' => $program_folder_id
            ]);
            \Log::info("Redirect URL: " . $redirectUrl);
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'redirect' => $redirectUrl,
                    'message' => 'Class list submitted successfully!'
                ]);
            }
    
            return redirect($redirectUrl)->with('success', 'Class list submitted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error saving class list: ' . $e->getMessage());
    
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'redirect' => $redirectUrl,
                    'message' => 'An error occurred while saving the class list.'
                ]);
            }
    
            return back()->with('error', 'An error occurred while saving the class list.');
        }
    }

    //logout
    public function facultyLogout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('faculty-login'));
    }

   
}