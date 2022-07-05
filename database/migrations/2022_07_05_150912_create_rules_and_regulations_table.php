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
        Schema::create('rules_and_regulations', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('content');
            $table->unsignedSmallInteger('status')->default(1)->comment("0: inactive, 1: active");

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
        Schema::dropIfExists('rules_and_regulations');
    }
};
