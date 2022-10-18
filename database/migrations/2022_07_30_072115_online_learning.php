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
        Schema::create('admin_list', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->string('admin_username',10)->unique(); //Make sure username only exist in database once
            $table->string('admin_password'); //Need Encrypt
            $table->tinyInteger('admin_role');
            $table->string('admin_name',40);
            $table->string('admin_email',50)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_list');
    }
};
