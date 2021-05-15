<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('title');
            $table->string('type');
            $table->string('description');
            $table->string('place');
            $table->integer('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * ID
    Start_date
    End_date
    Title
    Type
    Description
    Place
    Deleted

     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiences');
    }
}
