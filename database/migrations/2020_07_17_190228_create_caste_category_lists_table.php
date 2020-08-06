<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasteCategoryListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caste_category_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('religion')->nullable();
            $table->string('category')->nullable();
            $table->string('castename')->nullable();
            $table->string('subcaste')->nullable();
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
        Schema::dropIfExists('caste_category_lists');
    }
}
