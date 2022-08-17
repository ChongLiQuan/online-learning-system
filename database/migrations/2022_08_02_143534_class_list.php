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
            $table->increments('class_id');
            $table->string('class_name')->unique(); //Make sure username only exist in database once
            $table->integer('form_id')->unsigned()->default(0);
            $table->foreign('form_id')->references('form_id')->on('form_list')->onDelete('cascade'); 
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
