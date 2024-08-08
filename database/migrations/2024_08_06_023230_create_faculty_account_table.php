<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultyAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_account', function (Blueprint $table) {
            $table->bigIncrements('faculty_account_id');
            $table->string('email', 255)->index();
            $table->string('password', 255);
            $table->string('api_token', 80)->nullable()->index();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('verify_status')->default(0);
            $table->string('verification_code', 255)->nullable();
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
        Schema::dropIfExists('faculty_account');
    }
}
