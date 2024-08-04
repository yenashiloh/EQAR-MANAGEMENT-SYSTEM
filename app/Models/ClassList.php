<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassList extends Model
{
    use HasFactory;

    protected $table = 'class_list';

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

    protected $dates = ['dateFinished'];
}
