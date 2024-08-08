<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramFolder extends Model
{
    use HasFactory;

    protected $table = 'program_folder';

    protected $primaryKey = 'program_folder_id';

    protected $fillable = [
        'year_semestral_id',
        'admin_id',
        'folder_name',
    ];

    public function yearSemestral()
    {
        return $this->belongsTo(YearSemestralFolder::class, 'year_semestral_id', 'year_semestral_id');
    }
    
    public function admin()
    {
        return $this->belongsTo(AdminAccount::class, 'admin_id', 'id');
    }

    public function folderName()
    {
        return $this->belongsTo(FolderName::class, 'folder_name_id');
    }

}
