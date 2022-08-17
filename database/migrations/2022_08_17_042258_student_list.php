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
        Schema::create('student_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id')->nullable()->unique();
            $table->string('student_name')->unique(); 
            $table->string('student_IC')->unique();; 
            $table->integer('student_form');
            $table->integer('student_age');
            $table->string('student_address');
            $table->string('student_email');
            $table->string('student_gender');
            $table->date('student_dob');

            $table->string('parent_name')->nullable();
            $table->string('parent_IC'); 
            $table->integer('parent_hp'); 
            $table->string('parent_occupation');
            $table->integer('parent_age');
            $table->string('parent_address'); 
            $table->string('relationship'); 
            $table->date('parent_dob');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_list');

    }
};
