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
            $table->string('edu_id',12)->nullable()->unique();
            $table->string('edu_name',40)->unique(); //Make sure username only exist in database once
            $table->string('edu_IC',12)->unique();; //Make sure username only exist in database once
            $table->tinyInteger('edu_year');
            $table->tinyInteger('edu_age');
            $table->string('edu_address',50);
            $table->string('edu_email',30);
            $table->string('edu_gender',6);
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
