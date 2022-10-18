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
            $table->string('student_id',12)->nullable()->unique();
            $table->string('student_name',40)->unique(); 
            $table->string('student_IC',12)->unique();; 
            $table->tinyInteger('student_form',);
            $table->tinyInteger('student_age');
            $table->string('student_address',50);
            $table->string('student_email',30);
            $table->string('student_gender',6);
            $table->date('student_dob');
            $table->string('student_class')->nullable();

            $table->string('parent_name',40)->nullable();
            $table->string('parent_IC',12); 
            $table->string('parent_hp',15); 
            $table->string('parent_occupation',30);
            $table->tinyInteger('parent_age');
            $table->string('parent_address',150); 
            $table->string('relationship',20); 
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
