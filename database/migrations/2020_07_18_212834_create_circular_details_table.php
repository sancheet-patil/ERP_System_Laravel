<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircularDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circular_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicyear')->nullable();
            $table->string('circulardate')->nullable();
            $table->string('contenttitle')->nullable();
            $table->string('contenttype')->nullable();
            $table->string('availablefor')->nullable();
            $table->string('description')->nullable();
            $table->string('contentpath')->nullable();
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
        Schema::dropIfExists('circular_details');
    }
}
