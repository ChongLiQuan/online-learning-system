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
        Schema::create('class_subject_list', function (Blueprint $table) {
            $table->increments('class_subject_id');

            $table->string('subject_code',10); 
            $table->foreign('subject_code')->references('subject_code')->on('subject_list')->onDelete('cascade'); 

            $table->string('class_name',20);
            $table->foreign('class_name')->references('class_name')->on('class_list')->onDelete('cascade'); 

            $table->string('educator_id',12); 
            $table->foreign('educator_id')->references('edu_id')->on('educator_list')->onDelete('cascade'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_subject_list');

    }
};
