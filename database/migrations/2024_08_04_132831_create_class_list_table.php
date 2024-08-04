<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_list', function (Blueprint $table) {
            $table->id();
            $table->string('reporting_to');
            $table->string('department');
            $table->string('collegeCampus')->nullable();
            $table->string('courseTitle');
            $table->string('courseCode');
            $table->string('assignedTask');
            $table->date('dateFinished');
            $table->text('supportingDocuments')->nullable();
            $table->string('fileUpload');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_list');
    }
};
