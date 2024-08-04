<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRecord extends Model
{
    use HasFactory;

    protected $table = 'class_records';

    protected $fillable = [
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
    ];
}
