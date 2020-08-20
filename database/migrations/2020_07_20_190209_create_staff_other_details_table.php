<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffOtherDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_other_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('userid')->nullable();
            $table->string('epfno')->nullable();
            $table->string('basicsalary')->nullable();
            $table->string('contracttype')->nullable();
            $table->string('seniorscale')->nullable();
            $table->string('mostseniorscale')->nullable();
            $table->string('accounttitle')->nullable();
            $table->string('accountno')->nullable();
            $table->string('bankifsccode')->nullable();
            $table->string('bankname')->nullable();
            $table->string('bankbranchname')->nullable();
            $table->string('bankmicrcode')->nullable();
            $table->string('salarytitle')->nullable();
            $table->string('salaryaccountno')->nullable();
            $table->string('salaryifsc')->nullable();
            $table->string('salarybank')->nullable();
            $table->string('salarybranch')->nullable();
            $table->string('salarymicr')->nullable();
            $table->string('pensiontitle')->nullable();
            $table->string('pensionaccountno')->nullable();
            $table->string('pensionifsc')->nullable();
            $table->string('pensionbank')->nullable();
            $table->string('pensionbranch')->nullable();
            $table->string('pensionmicr')->nullable();
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
        Schema::dropIfExists('staff_other_details');
    }
}
