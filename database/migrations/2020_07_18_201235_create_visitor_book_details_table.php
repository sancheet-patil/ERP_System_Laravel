<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorBookDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_book_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicyear')->nullable();
            $table->string('visitpurpose')->nullable();
            $table->string('visitorname')->nullable();
            $table->string('visitorphone')->nullable();
            $table->string('visitoridcard')->nullable();
            $table->string('visitoridcardnumber')->nullable();
            $table->string('visitdate')->nullable();
            $table->string('intime')->nullable();
            $table->string('outtime')->nullable();
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
        Schema::dropIfExists('visitor_book_details');
    }
}
