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

class MaintenanceController extends Controller
{
    //show folder maintenance
    public function folderMaintenancePage()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin-login');
        }

        $adminId = auth()->guard('admin')->id();
        $admin = \App\Models\AdminAccount::find($adminId);
        $adminName = $admin->name;
        
        $folders = FolderName::all();

        return view('admin.maintenance.create-folder', [
            'adminName' => $adminName,
            'folders' => $folders
        ]);
    }

    //store main folder
    public function storeFolder(Request $request)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
            'main_folder_name' => 'required|string',
        ]);
    
        FolderName::create([
            'admin_id' => auth()->guard('admin')->id(),
            'folder_name' => $request->folder_name,
            'main_folder_name' => $request->main_folder_name,
        ]);
    
        return redirect()->route('admin.maintenance.create-folder')->with('success', 'Folder added successfully!');
    }
    
    //update main folder
    public function updateFolder(Request $request, $folder_name_id)
    {
        $request->validate([
            'folder_name' => 'required|string|max:255',
            'main_folder_name' => 'required|string',
        ]);

        $folder = FolderName::findOrFail($folder_name_id);
        $folder->folder_name = $request->folder_name;
        $folder->main_folder_name = $request->main_folder_name;
        $folder->save();

        return redirect()->route('admin.maintenance.create-folder')
                        ->with('success', 'Folder updated successfully!')
                        ->with('updated_folder_id', $folder_name_id);
    }

    //delete main folder
    public function deleteFolder($folder_name_id)
    {
        $deleted = FolderName::destroy($folder_name_id);
    
        if ($deleted) {
            return response()->json(['success' => true, 'message' => 'Folder deleted successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete the folder.'], 500);
        }
    }
    
    
}
