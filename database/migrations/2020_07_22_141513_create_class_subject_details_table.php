<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSubjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_subject_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicyear')->nullable();
            $table->string('classname')->nullable();
            $table->string('division')->nullable();
            $table->string('faculty')->nullable();
            $table->string('subjectname')->nullable();
            $table->string('outofmarks')->nullable();
            $table->string('teachername')->nullable();
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
        Schema::dropIfExists('class_subject_details');
    }
}
