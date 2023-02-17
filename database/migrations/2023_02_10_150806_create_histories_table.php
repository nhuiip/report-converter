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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId')->unsigned()->comment('assignee');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->int('reference')->comment('issueKey');
            $table->int('referenceType')->comment('1: Sub-Task, 2:Bug');
            $table->int('referenceParent')->comment('has value if type is bug');
            $table->int('lavel')->comment('1: High, 2: Medium, 3: Low, 4: Lowest');
            $table->dateTime('created');
            $table->int('manday')->nullable();
            $table->int('points')->nullable();
            $table->dateTime('startDate')->nullable();
            $table->dateTime('deliveryDate')->nullable();
            $table->dateTime('workDay')->nullable();
            $table->int('tracking')->comment('1: Normal, 2: Fast, 3: Late')->nullable();
            $table->decimal('totalPoints')->nullable();
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
        Schema::dropIfExists('histories');
    }
};
