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
        Schema::create('user_server_dbs', function (Blueprint $table) {
            $table->id();
            $table->string("url_name");
            $table->unsignedBigInteger('user_id');
            $table->boolean("status");
            $table->dateTime("date_up")->nullable();
            $table->dateTime("date_down")->nullable();
            $table->dateTime("date_time_reset");
            $table->boolean("server_up_email")->nullable();
            $table->boolean("server_down_email")->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_server_dbs');
    }
};
