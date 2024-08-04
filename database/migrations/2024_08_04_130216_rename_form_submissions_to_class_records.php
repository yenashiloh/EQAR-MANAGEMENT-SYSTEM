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
        Schema::rename('form_submissions', 'class_records');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('class_records', 'form_submissions');
          
    }
};
