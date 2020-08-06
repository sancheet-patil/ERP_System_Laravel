<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentOtherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_other_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userid')->nullable();
            $table->string('fathername')->nullable();
            $table->string('fatherphone')->nullable();
            $table->string('fatheroccupation')->nullable();
            $table->string('mothername')->nullable();
            $table->string('motherphone')->nullable();
            $table->string('motheroccupation')->nullable();
            $table->string('guardianname')->nullable();
            $table->string('guardianphone')->nullable();
            $table->string('guardianrelation')->nullable();
            $table->string('guardianoccupation')->nullable();
            $table->string('guardianaddress')->nullable();
            $table->string('document1name')->nullable();
            $table->string('document1file')->nullable();
            $table->string('document2name')->nullable();
            $table->string('document2file')->nullable();
            $table->string('document3name')->nullable();
            $table->string('document3file')->nullable();
            $table->string('document4name')->nullable();
            $table->string('document4file')->nullable();
            $table->string('document5name')->nullable();
            $table->string('document5file')->nullable();
            $table->string('document6name')->nullable();
            $table->string('document6file')->nullable();
            $table->string('accounttitle')->nullable();
            $table->string('accountno')->nullable();
            $table->string('bankifsccode')->nullable();
            $table->string('bankname')->nullable();
            $table->string('bankbranchname')->nullable();
            $table->string('bankmicrcode')->nullable();

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
        Schema::dropIfExists('student_other_details');
    }
}
