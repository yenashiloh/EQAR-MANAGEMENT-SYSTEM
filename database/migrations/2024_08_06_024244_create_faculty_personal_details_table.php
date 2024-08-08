<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyPersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_personal_details', function (Blueprint $table) {
            $table->bigIncrements('id_personal_details');
            $table->unsignedBigInteger('faculty_account_id')->index();
            $table->foreign('faculty_account_id')->references('faculty_account_id')->on('faculty_account')->onDelete('cascade');
            $table->string('first_name', 255);
            $table->string('middle_name', 255)->nullable();
            $table->string('last_name', 255);
            $table->date('birthday');
            $table->enum('sex', ['Male', 'Female']);
            $table->string('department', 255);
            $table->string('id_number', 255)->index();
            $table->enum('employee_type', ['Part Time', 'Regular']);
            $table->string('phone_number');
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
        Schema::table('faculty_personal_details', function (Blueprint $table) {
            $table->dropForeign(['faculty_account_id']);
        });

        Schema::dropIfExists('faculty_personal_details');
    }
}
