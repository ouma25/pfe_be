<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user');
            $table->integer('professional');
            $table->integer('stars_number');
            $table->integer('deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *ID
    Stars_number
    Comment
    Flags_number
    Deleted

     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
