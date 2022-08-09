<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('educator_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('edu_id')->nullable()->unique();
            $table->string('edu_name')->unique(); //Make sure username only exist in database once
            $table->string('edu_IC')->unique();; //Make sure username only exist in database once
            $table->integer('edu_year');
            $table->integer('edu_age');
            $table->string('edu_address');
            $table->string('edu_email');
            $table->string('edu_gender');
            $table->date('edu_dob');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educator_list');
    }
};
