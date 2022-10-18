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
        Schema::create('announcement_list', function (Blueprint $table) {
            $table->increments('annouce_id');

            $table->string('annouce_title',100);

            $table->integer('class_subject_id')->unsigned()->default(0);
            $table->foreign('class_subject_id')->references('class_subject_id')->on('class_subject_list')->onDelete('cascade'); 

            $table->text('annouce_content');

            $table->string('annouce_educator',40);

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
        Schema::dropIfExists('announcement_list');
    }
};
