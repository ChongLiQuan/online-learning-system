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
        Schema::create('student_note_folder_list', function (Blueprint $table) {
            $table->increments('student_folder_id');

            $table->string('student_folder_name',100);

            $table->string('student_id')->nullable();
            $table->foreign('student_id')->references('student_id')->on('student_list')->onDelete('cascade');

            $table->tinyInteger('student_subFolder')->nullable();

            $table->timestamp('deleted_date')->nullable();

            $table->boolean('active_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_note_folder_list');
    }
};
