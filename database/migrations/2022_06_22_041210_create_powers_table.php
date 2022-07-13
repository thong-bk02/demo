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
        Schema::create('powers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('position_id');
            $table->integer('users');
            $table->integer('position');
            $table->integer('department');
            $table->integer('terms_and_service');
            $table->integer('event');
            $table->integer('salary');
            $table->integer('timekeeping');
            $table->integer('reward_and_disciplines');
            $table->foreign('position_id')->references('id')->on('positions');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('powers');
    }
};
