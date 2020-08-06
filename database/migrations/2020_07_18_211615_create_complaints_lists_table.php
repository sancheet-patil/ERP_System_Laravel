<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplaintsListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicyear')->nullable();
            $table->string('complaintby')->nullable();
            $table->string('phone')->nullable();
            $table->string('complaintdate')->nullable();
            $table->string('description')->nullable();
            $table->string('assigned')->nullable();
            $table->string('actiontaken')->nullable();
            $table->string('complaintstatus')->default('Pending');
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
        Schema::dropIfExists('complaints_lists');
    }
}
