<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FolderName extends Model
{
    use HasFactory;

    protected $table = 'folder_name';
    protected $primaryKey = 'folder_name_id'; 

    protected $fillable = [
        'admin_id',
        'folder_name',
        'main_folder_name',    
    ];

    public function admin()
    {
        return $this->belongsTo(AdminAccount::class, 'admin_id', 'id');
    }
}


