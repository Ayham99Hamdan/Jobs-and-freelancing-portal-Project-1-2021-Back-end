<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->default('ayham');
            $table->string('last_name')->default('ayham');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();
            $table->text('password');
            $table->text('avatar')->nullable();
            $table->bigInteger('job_role_id')->unsigned()->nullable();
            $table->tinyInteger('gender')->nullable(); // 1 for male 0 for female
            $table->timestamps();
            $table->foreign('job_role_id')->references('id')->on('job_roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
