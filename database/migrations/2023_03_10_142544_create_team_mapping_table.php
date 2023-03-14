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
        Schema::create('team_mapping', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('userId')->unsigned()->comment('assignee');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('teamId')->unsigned()->comment('assignee');
            $table->foreign('teamId')->references('id')->on('teams')->onDelete('cascade');
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
        Schema::dropIfExists('team_mapping');
    }
};
