<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ClassRecordController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FacultyController::class, 'showRolePage'])->name('role');

/*****************************************ADMIN****************************************/
    //Login
    Route::get('/admin-login', [AdminController::class, 'showLoginPage'])
        ->name('admin-login')
        ->middleware(\App\Http\Middleware\PreventBackHistory::class);

    Route::post('/admin-login', [AdminController::class, 'loginPost'])
    ->name('admin-login.post')
        ->middleware(\App\Http\Middleware\PreventBackHistory::class);

Route::middleware(['auth:admin', 'prevent-back-history'])->group(function () {
    //Accomplishment
    Route::get('/admin-accomplishment', [AdminController::class, 'accomplishmentPage'])->name('admin.admin-accomplishment');
    Route::get('/accomplishments/class-records/admin-class-records', [AdminController::class, 'classRecordsPage'])->name('admin.accomplishments.class-records.admin-class-records');
    Route::get('/accomplishments/admin-add-accomplishment', [AdminController::class, 'addAccomplishmentPage'])->name('admin.accomplishments.admin-add-accomplishment');

    //Class Records
    Route::post('/accomplishments/class-records/year-semestral/{folder_name_id}', [ClassRecordController::class, 'storeYearSemestralFolder'])
    ->name('admin.accomplishment.class-records.year-semestral.store');
    // View Main Folder
    Route::get('/admin/accomplishments/class-records/view-folders/{id}', [ClassRecordController::class, 'viewFolder'])->name('admin.accomplishments.class-records.view-folders');
    // Edit Main Folder
    Route::post('/accomplishments/class-records/edit-folder/{id}', [ClassRecordController::class, 'editFolder'])->name('admin.accomplishments.editFolder');
    // Delete Main Folder
    Route::delete('/accomplishments/class-records/delete-folder/{id}', [ClassRecordController::class, 'deleteFolder'])->name('admin.accomplishments.deleteFolder');

    //Program Folders
    Route::post('admin/accomplishments/class-records/view-folders/{id}', [ClassRecordController::class, 'storeProgramFolder'])->name('admin.accomplishments.storeProgramFolder');
    //View All Files
    Route::get('/admin/accomplishments/class-records/all-uploaded-file/{id}', [ClassRecordController::class, 'viewAllFiles'])->name('admin.accomplishments.class-records.all-uploaded-file');
   // Edit Program Folder
    Route::post('/admin/accomplishments/class-records/edit-program-folder/{program_folder_id}', [ClassRecordController::class, 'editProgramFolder'])->name('admin.accomplishments.editProgramFolder');
    // Delete Program Folder
    Route::delete('/admin/accomplishments/view-folders/delete-program-folder/{id}', [ClassRecordController::class, 'deleteProgramFolder'])->name('admin.accomplishments.deleteProgramFolder');

    //Records
    Route::get('/reports/admin-hap', [AdminController::class, 'hapPage'])->name('admin.reports.admin-hap');
    
    //Maintenance
    Route::get('/maintenance/create-folder', [MaintenanceController::class, 'folderMaintenancePage'])->name('admin.maintenance.create-folder');
    Route::post('/maintenance/store-folder', [MaintenanceController::class, 'storeFolder'])->name('admin.maintenance.store-folder');
    Route::put('/maintenance/create-folder/update-folder/{folder_name_id}', [MaintenanceController::class, 'updateFolder'])->name('admin.maintenance.update-folder');
    Route::delete('/maintenance/create-folder/delete-folder/{folder_name_id}', [MaintenanceController::class, 'deleteFolder'])->name('admin.maintenance.delete-folder');
    Route::get('/accomplishment/class-records/year-semestral/{folder_name_id}', [AdminController::class, 'showYearSemestralFolder'])->name('admin.accomplishment.class-records.year-semestral');
    Route::get('/class-records/{id}', [ClassRecordController::class, 'showClassList'])->name('class-records.show');

    //Logout
    Route::post('/admin-logout', [AdminController::class, 'adminLogout'])->name('admin-logout');
});


/****************************************FACULTY**************************************/
    //Sign Up
    Route::get('/faculty-sign-up', [FacultyController::class, 'showSignUpPage'])
        ->name('faculty-sign-up')
        ->middleware(\App\Http\Middleware\PreventBackHistory::class);
    Route::post('/faculty-sign-up', [FacultyController::class, 'signUpPost'])->name('faculty-sign-up.post');

    //Login
    Route::get('/faculty-login', [FacultyController::class, 'showLoginPage'])
        ->name('faculty-login')
        ->middleware(\App\Http\Middleware\PreventBackHistory::class);
        
    Route::post('/faculty-login', [FacultyController::class, 'loginPost'])->name('login.post');

    //Verification OTP
    Route::get('/otp-verification', [FacultyController::class, 'showOtpVerificationForm'])
        ->name('otp-verification')
        ->middleware(\App\Http\Middleware\PreventBackHistory::class);
    Route::post('/verify-otp', [FacultyController::class, 'verifyOtp'])->name('verify-otp');
    Route::get('/verified', [FacultyController::class, 'showVerifiedCheck'])->name('verified');

Route::middleware(['auth'])->group(function () {
    //Verification Email
    Route::post('/resend-otp', [FacultyController::class, 'resendOtp'])->name('resend-otp');
    
    //Accomplishment
    Route::get('/faculty-accomplishment', [FacultyController::class, 'accomplishmentPage'])->name('faculty.faculty-accomplishment');

    //Class Records
    Route::get('/accomplishments/faculty-class-records', [FacultyController::class, 'classRecordsPage'])->name('faculty.accomplishments.faculty-class-records');
    //View the accomplishment Page
    Route::get('/accomplishments/folders/add-accomplishment/{program_folder_id}', [FacultyController::class, 'addAccomplishmentPage'])->name('faculty.accomplishments.add-accomplishment');
    //Store accomplishment
    Route::post('/accomplishments/folders/add-accomplishment/{program_folder_id}', [FacultyController::class, 'storeAccomplishment'])->name('faculty.accomplishments.store-accomplishment');

    //Class List
    Route::get('/accomplishments/faculty-class-list', [FacultyController::class, 'classListPage'])->name('faculty.accomplishments.faculty-class-list');
    Route::get('/accomplishments/faculty-add-class-list', [FacultyController::class, 'addClassListFormPage'])->name('faculty.accomplishments.faculty-add-class-list');

    Route::post('/accomplishments/folders/store-class-list/{program_folder_id}', [FacultyController::class, 'storeClassList'])->name('faculty.accomplishments.folders.store-class-list');

    Route::get('/accomplishments/class-lists/{id}/edit', [FacultyController::class, 'edit'])->name('class-lists.edit');

    // Delete
    Route::delete('/accomplishments/class-lists/{id}', [FacultyController::class, 'destroy'])->name('class-lists.destroy');

    //Show year semestral folder page 
    Route::get('/accomplishments/folders/all-uploaded-file/{folder_name_id}', [FacultyController::class, 'showYearSemestralFolder'])->name('faculty.accomplishments.folders.year-semestral');

    // View Main Folder
    Route::get('/faculty/accomplishments/folders/view-folders/{id}', [FolderController::class, 'viewFolderFaculty'])->name('faculty.accomplishments.folders.view-folders');

    //Program Folder
    Route::get('/faculty/accomplishments/folders/all-uploaded-file/{id}', [FolderController::class, 'viewAllFiles'])->name('faculty.accomplishments.folders.all-uploaded-file');
    Route::delete('/accomplishments/folders/delete-folder/{id}', [FolderController::class, 'destroy'])->name('class-lists.destroy');
    Route::get('/accomplishments/folders/view-details/{id}', [FolderController::class, 'viewAllDetailsPage'])->name('faculty.accomplishments.folders.view-details');
    
    Route::get('/class-lists/{id}', [FolderController::class, 'show'])->name('class-lists.show');

    //Logout
    Route::post('/logout', [FacultyController::class, 'facultyLogout'])->name('logout');

    // Show the edit form
    Route::get('/faculty/accomplishments/folders/edit-file/{id}', [FolderController::class, 'edit'])->name('faculty.accomplishments.folders.edit-file');

    // Update the record
    Route::post('/faculty/accomplishments/folders/update/{id}', [FolderController::class, 'update'])->name('faculty.accomplishments.folders.update-file');


});
