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
            $table->unsignedBigInteger('timekeeping');
            $table->string('month');
            $table->unsignedBigInteger('coefficients_salary');
            $table->double('subsidize');
            $table->bigInteger('total_reward')->default(0)->nullable();
            $table->bigInteger('total_discipline')->default(0)->nullable();
            $table->double('total_money');
            $table->unsignedBigInteger('income_tax');
            $table->unsignedBigInteger('payment');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('timekeeping')->references('id')->on('timekeepings');
            $table->foreign('coefficients_salary')->references('id')->on('coefficients_salarys');
            $table->foreign('income_tax')->references('id')->on('income_taxs');
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
