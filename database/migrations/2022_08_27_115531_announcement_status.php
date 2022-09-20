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
        Schema::create('announcement_status', function (Blueprint $table) {
            $table->increments('announcement_status_id');

            $table->string('student_id');
            $table->foreign('student_id')->references('student_id')->on('student_list')->onDelete('cascade');

            $table->integer('annouce_id')->unsigned();
            $table->foreign('annouce_id')->references('annouce_id')->on('announcement_list')->onDelete('cascade'); 
            
            $table->boolean('annouce_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('announcement_status');
    }
};
