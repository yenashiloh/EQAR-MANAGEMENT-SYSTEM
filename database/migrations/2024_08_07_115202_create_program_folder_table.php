<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramFolderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_folder', function (Blueprint $table) {
            $table->id('program_folder_id');
            $table->foreignId('year_semestral_id')->constrained('year_semestral_folder');
            $table->foreignId('admin_id')->constrained('admin_account');
            $table->string('folder_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_folder');
    }
}
