<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userid')->nullable();
            $table->string('staffid')->nullable();
            $table->string('staffrole')->nullable();
            $table->string('designation')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->string('mothername')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('bloodgroup')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->string('religion')->nullable();
            $table->string('category')->nullable();
            $table->string('castename')->nullable();
            $table->string('subcaste')->nullable();
            $table->string('aadhar')->nullable();
            $table->string('mothertongue')->nullable();
            $table->string('placeob')->nullable();
            $table->string('joiningdate')->nullable();
            $table->string('shalarthid')->nullable();
            $table->string('pannumber')->nullable();
            $table->string('retirementdate')->nullable();
            $table->string('staffphoto')->nullable();
            $table->string('qualificationdetails')->nullable();
            $table->string('experiencedetails')->nullable();
            $table->string('currentaddress')->nullable();
            $table->string('permanentaddress')->nullable();
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
        Schema::dropIfExists('staff_details');
    }
}
