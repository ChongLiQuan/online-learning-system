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
        Schema::create('messages_list', function (Blueprint $table) {
            $table->increments('message_id');

            $table->string('from_user_id',12);
            $table->foreign('from_user_id')->references('user_name')->on('user_login_details')->onDelete('cascade');
            
            $table->string('to_user_id',12);

            $table->string('message_content');

            $table->datetime('message_date');

            $table->boolean('message_is_new_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages_list');
    }
};
