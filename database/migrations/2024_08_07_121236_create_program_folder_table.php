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
            $table->unsignedBigInteger('year_semestral_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('folder_name');
            $table->timestamps();

            $table->foreign('year_semestral_id')->references('year_semestral_id')->on('year_semestral_folder')->onDelete('cascade');
            $table->foreign('admin_id')->references('id')->on('admin_account')->onDelete('cascade');
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
