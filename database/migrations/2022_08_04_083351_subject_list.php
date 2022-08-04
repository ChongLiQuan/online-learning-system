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
        Schema::create('subject_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject_code')->unique(); //Make sure username only exist in database once
            $table->string('subject_name'); //Make sure username only exist in database once
            $table->integer('form_level'); 
            $table->foreign('form_level')->references('form_level')->on('form_list')->onDelete('cascade'); 
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_list');
    }
};
