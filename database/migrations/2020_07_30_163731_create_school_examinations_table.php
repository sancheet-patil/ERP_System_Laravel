<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_examinations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicyear')->nullable();
            $table->string('classname')->nullable();
            $table->string('division')->nullable();
            $table->string('semester')->nullable();
            $table->string('studentid')->nullable();
            $table->string('subjectname')->nullable();
            $table->string('marks')->nullable();
            $table->string('specialremarks')->nullable();
            $table->string('hobbies')->nullable();
            $table->string('otherremarks')->nullable();
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
        Schema::dropIfExists('school_examinations');
    }
}
