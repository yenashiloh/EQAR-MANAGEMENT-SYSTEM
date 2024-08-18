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
        Schema::table('folder_name', function (Blueprint $table) {
            $table->string('main_folder_name')->after('folder_name'); 
            $table->boolean('status')->default(true)->after('main_folder_name'); 
        });
    }

    public function down()
    {
        Schema::table('folder_name', function (Blueprint $table) {
            $table->dropColumn('main_folder_name');
            $table->dropColumn('status');
        });
    }

};
