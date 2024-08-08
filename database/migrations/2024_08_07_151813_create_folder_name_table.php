<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolderNameTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('folder_name', function (Blueprint $table) {
            $table->id('folder_name_id'); 
            $table->unsignedBigInteger('admin_id'); 
            $table->string('folder_name');
            $table->string('main_folder_name');
            $table->timestamps();

            $table->foreign('admin_id')->references('id')->on('admin_account')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folder_name');
    }
}
