<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamEvaluationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_evaluation_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicyear')->nullable();
            $table->string('studentid')->nullable();
            $table->string('classname')->nullable();
            $table->string('division')->nullable();
            $table->string('faculty')->nullable();
            $table->string('examtype')->nullable();
            $table->string('subjectname')->nullable();
            $table->string('passingmarks')->nullable();
            $table->string('outofmarks')->nullable();
            $table->string('obtainedmarks')->nullable();
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
        Schema::dropIfExists('exam_evaluation_details');
    }
}
