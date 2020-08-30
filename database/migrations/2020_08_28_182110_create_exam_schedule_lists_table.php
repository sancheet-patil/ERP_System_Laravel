<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamScheduleListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_schedule_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('examtype')->nullable();
            $table->string('classname')->nullable();
            $table->string('faculty')->nullable();
            $table->string('subjectname')->nullable();
            $table->string('passingmarks')->nullable();
            $table->string('outofmarks')->nullable();
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
        Schema::dropIfExists('exam_schedule_lists');
    }
}
