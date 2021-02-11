<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('subject_name');
            $table->integer('attendance_score')->nullable();
            $table->integer('first_test')->nullable();
            $table->integer('second_test')->nullable();
            $table->integer('third_test')->nullable();
            $table->integer('quiz')->nullable();
            $table->integer('exam_score')->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('results');
    }
}
