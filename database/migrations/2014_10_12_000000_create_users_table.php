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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->default(null);
            $table->string('type')->default('client');
            $table->date('birthdate')->nullable();
            $table->string('job_title')->nullable();
            $table->string('image')->nullable();
            $table->string('image_cin')->nullable();
            $table->integer('service')->nullable();
            $table->integer('active')->default(1);
            $table->integer('deleted')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
