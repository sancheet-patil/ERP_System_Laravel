<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScholarshipApplyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarship_apply_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('academicyear')->nullable();
            $table->string('studentid')->nullable();
            $table->string('scholarship')->nullable();
            $table->string('scholarshipclass')->nullable();
            $table->string('scholarshipdivision')->nullable();
            $table->string('scholarshipfaculty')->nullable();
            $table->string('scholarshipamount')->nullable();
            $table->string('noofmonths')->nullable();
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
        Schema::dropIfExists('scholarship_apply_details');
    }
}
