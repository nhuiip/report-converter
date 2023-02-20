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
        Schema::create('histories_log', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('historyId')->unsigned()->comment('assignee');
            $table->foreign('historyId')->references('id')->on('histories')->onDelete('cascade');
            $table->bigInteger('importId')->unsigned()->comment('assignee');
            $table->foreign('importId')->references('id')->on('histories_import')->onDelete('cascade');
            $table->bigInteger('userId')->unsigned()->comment('assignee');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->integer('reference')->comment('issueKey');
            $table->integer('referenceType')->comment('1: Sub-Task, 2:Bug');
            $table->integer('referenceParent')->comment('has value if type is bug');
            $table->integer('lavel')->comment('1: High, 2: Medium, 3: Low, 4: Lowest');
            $table->dateTime('created');
            $table->integer('manday')->nullable();
            $table->integer('points')->nullable();
            $table->dateTime('startDate')->nullable();
            $table->dateTime('deliveryDate')->nullable();
            $table->dateTime('workDay')->nullable();
            $table->integer('tracking')->comment('1: Normal, 2: Fast, 3: Late')->nullable();
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
        Schema::dropIfExists('histories_log');
    }
};
