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
        Schema::create('student_note_list', function (Blueprint $table) {
            $table->increments('student_note_id');

            $table->string('student_name')->nullable();

            $table->string('student_note_name');

            $table->text('student_note_content')->nullable();

            $table->string('student_note_subject')->nullable();

            $table->integer('student_note_subFolder')->unsigned()->default(0);
            $table->foreign('student_note_subFolder')->references('student_folder_id')->on('student_note_folder_list')->onDelete('cascade');

            $table->boolean('share_status');

            $table->boolean('educator_approval_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_note_list');
    }
};
