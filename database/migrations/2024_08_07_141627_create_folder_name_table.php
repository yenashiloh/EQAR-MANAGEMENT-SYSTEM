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
        Schema::table('year_semestral_folder', function (Blueprint $table) {
            $table->unsignedBigInteger('folder_name_id')->nullable()->after('year_semestral_id');
            $table->foreign('folder_name_id')->references('folder_name_id')->on('folder_name')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('year_semestral_folder', function (Blueprint $table) {
            $table->dropForeign(['folder_name_id']);
            $table->dropColumn('folder_name_id');
        });
    }
};

