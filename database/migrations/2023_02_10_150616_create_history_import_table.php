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
        Schema::create('history_import', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->int('total');
            $table->int('success');
            $table->int('fail');
            $table->string('rawUrl');
            $table->string('successUrl')->nullable();
            $table->string('failUrl')->nullable();
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
        Schema::dropIfExists('history_import');
    }
};
