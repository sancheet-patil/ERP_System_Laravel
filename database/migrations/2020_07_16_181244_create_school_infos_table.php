<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('schoolname')->nullable();
            $table->string('address')->nullable();
            $table->string('taluka')->nullable();
            $table->string('district')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('faxnumber')->nullable();
            $table->string('website')->nullable();
            $table->string('estbdate')->nullable();
            $table->string('devname')->nullable();
            $table->string('devurl')->nullable();
            $table->string('maxlc')->nullable();
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
        Schema::dropIfExists('school_infos');
    }
}
