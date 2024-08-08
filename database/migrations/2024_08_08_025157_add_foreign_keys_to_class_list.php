<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToClassList extends Migration
{
    public function up()
    {
        Schema::table('class_list', function (Blueprint $table) {
            $table->foreign('program_folder_id')->references('program_folder_id')->on('program_folder')->onDelete('cascade');
            $table->foreign('faculty_account_id')->references('faculty_account_id')->on('faculty_account')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('class_list', function (Blueprint $table) {
            $table->dropForeign(['program_folder_id']);
            $table->dropForeign(['faculty_account_id']);
        });
    }
}