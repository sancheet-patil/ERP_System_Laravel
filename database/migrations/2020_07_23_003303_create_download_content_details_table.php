<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadContentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_content_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicyear')->nullable();
            $table->string('contenttitle')->nullable();
            $table->string('contenttype')->nullable();
            $table->string('availablefor')->nullable();
            $table->string('classname')->nullable();
            $table->string('division')->nullable();
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
        Schema::dropIfExists('download_content_details');
    }
}
