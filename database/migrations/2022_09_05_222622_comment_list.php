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
        Schema::create('comment_list', function (Blueprint $table) {
        $table->increments('comment_id');

        $table->string('comment_title');

        $table->text('comment_content')->nullable();

        $table->integer('discussion_id')->unsigned()->default(0);
        $table->foreign('discussion_id')->references('discussion_id')->on('discussion_list')->onDelete('cascade');
        
        $table->string('comment_username');

        $table->timestamps();

        $table->integer('sub_comment')->unsigned()->default(0)->nullable();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_list');

    }
};
