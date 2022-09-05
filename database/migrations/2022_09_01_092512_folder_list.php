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
        Schema::create('folder_list', function (Blueprint $table) {
            $table->increments('folder_id');

            $table->string('folder_name');

            $table->integer('class_subject_id')->unsigned()->default(0);
            $table->foreign('class_subject_id')->references('class_subject_id')->on('class_subject_list')->onDelete('cascade'); 
            
            $table->text('folder_content')->nullable();

            $table->integer('subFolder')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folder_list');

    }
};
