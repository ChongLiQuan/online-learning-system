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
        Schema::create('class_list', function (Blueprint $table) {
            $table->increments('id');
            $table->string('class_name')->unique(); //Make sure username only exist in database once
            $table->string('form_name');    
            $table->foreign('form_name')->references('form_name')->on('form_list')->onDelete('cascade'); 
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_list');
    }
};
