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

            $table->string('power_name');
            $table->unsignedSmallInteger('users');
            $table->unsignedSmallInteger('position');
            $table->unsignedSmallInteger('department');
            $table->unsignedSmallInteger('terms_and_service');
            $table->unsignedSmallInteger('event');
            $table->unsignedSmallInteger('salary');
            $table->unsignedSmallInteger('overtime');
            $table->unsignedSmallInteger('absence');
            $table->unsignedSmallInteger('timekeeping');
            $table->unsignedSmallInteger('reward_and_disciplines');
            $table->unsignedSmallInteger('project');
            $table->unsignedSmallInteger('task_list');

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
