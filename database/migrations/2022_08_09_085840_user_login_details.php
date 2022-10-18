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
        Schema::create('user_login_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name',12)->nullable()->unique();
            $table->string('user_password')->unique(); //Make sure username only exist in database once
            $table->tinyInteger('user_role');
            $table->string('user_full_name',40);
            $table->string('user_email',30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_login_details');
    }
};
