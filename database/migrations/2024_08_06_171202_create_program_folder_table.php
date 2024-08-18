<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('program_folder', function (Blueprint $table) {
            $table->bigIncrements('program_folder_id');
            $table->string('year_semestral_id'); // Change to string to match the YearSemestralFolder model
            $table->string('folder_name', 255);
            $table->unsignedBigInteger('admin_id');
            $table->timestamps();

            // Define indexes and foreign key constraints
            $table->index('admin_id');
            $table->index('year_semestral_id');
        });

        // Add foreign key constraints separately
        Schema::table('program_folder', function (Blueprint $table) {
            $table->foreign('admin_id')
                  ->references('id')
                  ->on('admin_account')
                  ->onDelete('cascade');

            $table->foreign('year_semestral_id')
                  ->references('year_semestral_id') // Ensure this matches the primary key in YearSemestralFolder
                  ->on('year_semestral_folder')
                  ->onDelete('cascade');
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
};