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
        Schema::create('discussion_list', function (Blueprint $table) {
            $table->increments('discussion_id');

            $table->string('discussion_title');

            $table->text('discussion_content')->nullable();
            $table->text('discussion_educator')->nullable();

            $table->integer('folder_id')->unsigned()->default(0);
            $table->foreign('folder_id')->references('folder_id')->on('folder_list')->onDelete('cascade');
            
            $table->boolean('discussion_student_reply');

            $table->boolean('discussion_student_edit');

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
        Schema::dropIfExists('discussion_list');
    }
};
