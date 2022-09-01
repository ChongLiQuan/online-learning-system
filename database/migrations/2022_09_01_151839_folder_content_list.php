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
        Schema::create('folder_content_list', function (Blueprint $table) {
            $table->increments('content_id');

            $table->string('content_title');

            $table->text('content')->nullable();


            $table->integer('folder_id')->unsigned()->default(0);
            $table->foreign('folder_id')->references('folder_id')->on('folder_list')->onDelete('cascade'); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folder_content_list');

    }
};
