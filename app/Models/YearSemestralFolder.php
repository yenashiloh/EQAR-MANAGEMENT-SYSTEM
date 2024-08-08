<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YearSemestralFolder extends Model
{
    use HasFactory;

    protected $table = 'year_semestral_folder';

    protected $primaryKey = 'year_semestral_id';

    protected $fillable = [
        'folder_name',
        'admin_id',
        'folder_name_id', 
    ];

    public function admin()
    {
        return $this->belongsTo(AdminAccount::class, 'admin_id');
    }

    public function folderName()
    {
        return $this->belongsTo(FolderName::class, 'folder_name_id', 'folder_name_id');
    }
}

