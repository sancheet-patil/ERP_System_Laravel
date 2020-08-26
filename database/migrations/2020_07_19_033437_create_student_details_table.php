<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userid')->nullable();
            $table->string('academicyear')->nullable();
            $table->string('registerfor')->nullable();
            $table->string('faculty')->nullable();
            $table->string('classname')->nullable();
            $table->string('division')->default('NA');
            $table->integer('registerno')->nullable();
            $table->string('admission_date')->nullable();
            $table->string('admission_class')->nullable();
            $table->string('admission_year')->nullable();
            $table->string('saralid')->nullable();
            $table->integer('roll_no')->nullable();
            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->string('gender')->nullable();
            $table->string('dob')->nullable();
            $table->string('religion')->nullable();
            $table->string('category')->nullable();
            $table->string('castename')->nullable();
            $table->string('subcaste')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('aadhar')->unique();
            $table->string('placeob')->nullable();
            $table->string('mothertongue')->nullable();
            $table->string('bloodgroup')->nullable();
            $table->string('pwd')->nullable();
            $table->string('familyincome')->nullable();
            $table->string('isminor')->nullable();
            $table->string('schoolname')->nullable();
            $table->string('lastschool')->nullable();
            $table->string('lastclass')->nullable();
            $table->string('studentphoto')->nullable();
            $table->string('admissiontype')->nullable();
            $table->string('lateadmission')->nullable();
            $table->string('hostelrequired')->nullable();
            $table->string('citytype')->nullable();
            $table->string('previouslcno')->nullable();
            $table->string('previousgrno')->nullable();
            $table->string('currentaddress')->nullable();
            $table->string('permanentaddress')->nullable();
            $table->string('status')->nullable();
            $table->string('hasaccess')->default('1');

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
        Schema::dropIfExists('student_details');
    }
}
