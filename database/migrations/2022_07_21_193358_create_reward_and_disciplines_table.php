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
        Schema::create('reward_and_disciplines', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('type');
            $table->unsignedBigInteger('reasion');
            $table->string('note')->nullable();
            $table->double('money');
            $table->date('date_created');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('type')->references('id')->on('genre');
            $table->foreign('reasion')->references('id')->on('reasion');

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
        Schema::dropIfExists('reward_and_disciplines');
    }
};
