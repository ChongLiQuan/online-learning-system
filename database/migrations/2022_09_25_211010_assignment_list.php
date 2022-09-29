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
        Schema::create('assignment_list', function (Blueprint $table) {
            $table->increments('assignment_id');

            $table->string('assignment_title');

            $table->text('assignment_content');

            $table->integer('assignment_full_mark');

            $table->datetime('assignment_due_date');

            $table->timestamp('assignment_created_at');

            $table->boolean('assignment_email_educator_status');

            $table->integer('subject_folder_id')->unsigned()->default(0);
            $table->foreign('subject_folder_id')->references('subject_folder_id')->on('subject_folder_list')->onDelete('cascade'); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_list');
    }
};
