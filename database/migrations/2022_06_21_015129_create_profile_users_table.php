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
        Schema::create('profile_users', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->unique();
            $table->string('user_code')->unique();
            $table->string('address');
            $table->string('phone')->unique();
            $table->date('birthday');
            $table->unsignedBigInteger('position');
            $table->unsignedBigInteger('department');
            $table->date('date_start');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('position')->references('id')->on('positions');
            $table->foreign('department')->references('id')->on('departments');
            
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
        Schema::dropIfExists('profile_users');
    }
};
