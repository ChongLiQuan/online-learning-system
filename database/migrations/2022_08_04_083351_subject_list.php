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
            $table->increments('subject_id');
            $table->string('subject_code',10)->unique(); //Make sure subject code only exist in database once
            $table->string('subject_name',60)->unique(); //Make sure subject name only exist in database once
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
        Schema::dropIfExists('subject_list');
    }
};
