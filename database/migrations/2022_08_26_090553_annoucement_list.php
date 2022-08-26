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
        Schema::create('annoucement_list', function (Blueprint $table) {
            $table->increments('id');

            $table->string('annouce_title');

            $table->string('annouce_subject');
            $table->foreign('annouce_subject')->references('subject_code')->on('class_subject_list')->onDelete('cascade'); 

            $table->string('annouce_class');
            $table->foreign('annouce_class')->references('class_name')->on('class_subject_list')->onDelete('cascade'); 

            $table->text('annouce_content');

            $table->string('annouce_educator');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annoucement_list');

    }
};
