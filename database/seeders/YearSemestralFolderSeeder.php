<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\YearSemestralFolder;

class YearSemestralFolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        YearSemestralFolder::create([
            'year_semestral_id' => 1,
            'folder_name' => 'Hello',
            'admin_id' => 1,
        ]);
    }
}
