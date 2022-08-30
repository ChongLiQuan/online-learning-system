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
            $table->increments('id');

            $table->string('student_name');

            $table->integer('annouce_id')->unsigned();
            $table->foreign('annouce_id')->references('id')->on('announcement_list')->onDelete('cascade'); 
            
            $table->boolean('status');
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
