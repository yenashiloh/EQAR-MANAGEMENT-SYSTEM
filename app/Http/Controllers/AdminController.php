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
use App\Models\FolderName;
use App\Models\ProgramFolder;

class AdminController extends Controller
{
    // public function homePage ()
    // {
    //     return view('admin.admin-home');
    // }

    //show login page
    public function showLoginPage()
    {
        return view('admin-login');
    }

    //login POST
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        Log::debug('Login attempt for:', ['email' => $credentials['email']]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();    
            Log::debug('Login successful for:', ['email' => $admin->email]);
            return redirect()->intended(route('admin.admin-accomplishment'));
        }

        Log::debug('Login failed for:', ['email' => $credentials['email']]);
        return redirect()->route('admin-login')->with("error", "Incorrect email address or password. Please try again.");
    }

    //show accomplishment page
    public function accomplishmentPage()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin-login');
        }
    
        $adminId = auth()->guard('admin')->id();
        $admin = \App\Models\AdminAccount::find($adminId);
        $adminName = $admin->name;
    
        $folders = FolderName::all();
    
        return view('admin.admin-accomplishment', [
            'adminName' => $adminName,
            'folders' => $folders
        ]);
    }
    
   // show semestral folders
    public function showYearSemestralFolder($folder_name_id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin-login');
        }

        $adminId = auth()->guard('admin')->id();
        $admin = \App\Models\AdminAccount::find($adminId);
        $adminName = $admin->name;

        $folder = \App\Models\FolderName::find($folder_name_id);

        $folders = \App\Models\YearSemestralFolder::where('folder_name_id', $folder_name_id)->get();

        return view('admin.accomplishments.class-records.year-semestral', [
            'adminName' => $adminName,
            'folder_name_id' => $folder_name_id,
            'folder' => $folder, 
            'folders' => $folders,
            'folderName' => $folder->folder_name 
        ]);
    }

    //show class record page
    public function classRecordsPage()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin-login');
        }
    
        $adminId = auth()->guard('admin')->id();
        $admin = \App\Models\AdminAccount::find($adminId);
        $adminName = $admin->name;
        $folders = YearSemestralFolder::with('admin')->get();
        $folders = \App\Models\YearSemestralFolder::where('admin_id', $adminId)->get();
    
        return view('admin.accomplishments.class-records.admin-class-records', [
            'adminName' => $adminName,
            'folders' => $folders,
        ]);
    }
   
    //show accomplishment page
    public function addAccomplishmentPage()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin-login');
        }
   
        $adminId = auth()->guard('admin')->id();
        $admin = \App\Models\AdminAccount::find($adminId);
    
        $adminName = $admin->name;
    
        return view('admin.accomplishments.admin-add-accomplishment', ['adminName' => $adminName]);
    }

    //show hap page
    public function hapPage()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin-login');
        }
   
        $adminId = auth()->guard('admin')->id();
        $admin = \App\Models\AdminAccount::find($adminId);
    
        $adminName = $admin->name;
    
        return view('admin.reports.admin-hap', ['adminName' => $adminName]);
    }

    
}
