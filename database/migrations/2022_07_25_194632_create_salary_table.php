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
        Schema::create('salary', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->string('salary_code')->unique();
            $table->date('month');
            $table->unsignedBigInteger('basic_salary');
            $table->double('subsidize')->nullable()->default(0);
            $table->bigInteger('total_reward')->default(0)->nullable();
            $table->bigInteger('total_discipline')->default(0)->nullable();
            $table->double('total_money');
            $table->integer('income_tax');
            $table->unsignedBigInteger('payment');
            $table->date('date_of_payment')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('basic_salary')->references('id')->on('basic_salary');
            $table->foreign('payment')->references('id')->on('payments');
            
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
        Schema::dropIfExists('salary');
    }
};
