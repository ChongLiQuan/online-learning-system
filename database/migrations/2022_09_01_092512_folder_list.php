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
        Schema::create('subject_folder_list', function (Blueprint $table) {
            $table->increments('subject_folder_id');

            $table->string('subject_folder_name',100);

            $table->integer('class_subject_id')->unsigned()->default(0);
            $table->foreign('class_subject_id')->references('class_subject_id')->on('class_subject_list')->onDelete('cascade'); 
            
            $table->text('subject_folder_content')->nullable();

            $table->tinyInteger('subject_subFolder')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_folder_list');

    }
};
