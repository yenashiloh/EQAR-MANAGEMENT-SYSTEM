<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassList extends Model
{
    use HasFactory;

    protected $table = 'class_list';

    protected $fillable = [
        'program_folder_id',
        'faculty_account_id', 
        'reporting_to',
        'department',
        'collegeCampus',
        'courseTitle',
        'courseCode',
        'assignedTask',
        'dateFinished',
        'supportingDocuments',
        'fileUpload',
        'notes',
        'original_file_name', 
    ];

    protected $casts = [
        'dateFinished' => 'datetime',
    ];


    public function programFolder()
    {
        return $this->belongsTo(ProgramFolder::class, 'program_folder_id');
    }

    public function faculty()
    {
        return $this->belongsTo(FacultyAccount::class, 'faculty_account_id');
    }
}
