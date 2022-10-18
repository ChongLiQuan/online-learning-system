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
        Schema::create('notification_list', function (Blueprint $table) {
            $table->increments('notification_id');

            $table->string('user_id',12);
            $table->foreign('user_id')->references('user_name')->on('user_login_details')->onDelete('cascade');

            $table->string('notification_title',100);

            $table->text('notification_content');
            
            $table->dateTime('created_at');

            $table->boolean('read_notification_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notification_list');
    }
};
