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
        Schema::create('assignment_submission_list', function (Blueprint $table) {
            $table->increments('submission_id');

            $table->integer('assignment_id')->unsigned()->default(0);
            $table->foreign('assignment_id')->references('assignment_id')->on('assignment_list')->onDelete('cascade');

            $table->string('student_id');
            $table->foreign('student_id')->references('student_id')->on('student_list')->onDelete('cascade');

            $table->text('submission_content');

            $table->datetime('submission_date');

            $table->integer('submission_mark')->nullable();
            $table->text('submission_educator_feedback')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_submission_list');
    }
};
