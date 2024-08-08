<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgramFolderAndFacultyAccountToClassList extends Migration
{
    public function up()
    {
        Schema::table('class_list', function (Blueprint $table) {
            $table->unsignedBigInteger('program_folder_id')->nullable()->after('id');
            $table->unsignedBigInteger('faculty_account_id')->nullable()->after('program_folder_id');
        });
    }

    public function down()
    {
        Schema::table('class_list', function (Blueprint $table) {
            $table->dropColumn(['program_folder_id', 'faculty_account_id']);
        });
    }
}