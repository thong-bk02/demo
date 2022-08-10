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
        Schema::create('timekeepings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('timekeeping_code')->unique();
            $table->date('timekeeping_month');
            $table->integer('working_days')->default(0);
            $table->double('day_off')->default(0)->nullable();
            $table->double('arrive_late')->default(0)->nullable();
            $table->double('hours_late')->default(0)->nullable();
            $table->double('leave_early')->default(0)->nullable();
            $table->double('hours_early')->default(0)->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timekeepings');
    }
};
