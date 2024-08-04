<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FacultyController;
use Illuminate\Support\Facades\Route;

/*****************************************ADMIN****************************************/
//Accomplishment
Route::get('/admin-accomplishment', [AdminController::class, 'accomplishmentPage'])->name('admin.admin-accomplishment');

//Class Records
Route::get('/accomplishments/admin-class-records', [AdminController::class, 'classRecordsPage'])->name('admin.accomplishments.admin-class-records');
Route::get('/accomplishments/admin-add-accomplishment', [AdminController::class, 'addAccomplishmentPage'])->name('admin.accomplishments.admin-add-accomplishment');

//Records
Route::get('/reports/admin-hap', [AdminController::class, 'hapPage'])->name('admin.reports.admin-hap');

/****************************************FACULTY**************************************/
//Accomplishment
Route::get('/faculty-accomplishment', [FacultyController::class, 'accomplishmentPage'])->name('faculty.faculty-accomplishment');

//Class Records
Route::get('/accomplishments/faculty-class-records', [FacultyController::class, 'classRecordsPage'])->name('faculty.accomplishments.faculty-class-records');
Route::get('/accomplishments/faculty-add-accomplishment', [FacultyController::class, 'addAccomplishmentPage'])->name('faculty.accomplishments.faculty-add-accomplishment');
Route::post('/faculty-class-record', [FacultyController::class, 'storeClassRecord'])->name('faculty.accomplishments.class-record-store');

//Class List
Route::get('/accomplishments/faculty-class-list', [FacultyController::class, 'classListPage'])->name('faculty.accomplishments.faculty-class-list');
Route::get('/accomplishments/faculty-add-class-list', [FacultyController::class, 'addClassListFormPage'])->name('faculty.accomplishments.faculty-add-class-list');
Route::post('/faculty-accomplishment', [FacultyController::class, 'storeClassList'])->name('faculty.accomplishments.class-list-store');

Route::get('/accomplishments/class-lists/{id}/edit', [FacultyController::class, 'edit'])->name('class-lists.edit');

// Route to handle the deletion of a class list item
Route::delete('/accomplishments/class-lists/{id}', [FacultyController::class, 'destroy'])->name('class-lists.destroy');


