<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_results', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class');
            $table->string('subject_name');
            $table->string('session');
            $table->string('term');
            $table->integer('attendance_score');
            $table->integer('first_test');
            $table->integer('second_test');
            $table->integer('third_test');
            $table->integer('quiz');
            $table->integer('exam_score');
            $table->integer('total');
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
        Schema::dropIfExists('academic_results');
    }
}
