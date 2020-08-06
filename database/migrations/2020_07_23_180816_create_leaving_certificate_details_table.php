<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavingCertificateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaving_certificate_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicyear')->nullable();
            $table->string('studentid')->nullable();
            $table->string('progress')->nullable();
            $table->string('conduct')->nullable();
            $table->string('dateofleaving')->nullable();
            $table->string('reasonofleaving')->nullable();
            $table->string('remarks')->nullable();
            $table->string('studyinginclass')->nullable();
            $table->string('issuedate')->nullable();
            $table->string('printcount')->default('0');
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
        Schema::dropIfExists('leaving_certificate_details');
    }
}
