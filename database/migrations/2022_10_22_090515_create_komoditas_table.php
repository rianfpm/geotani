<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomoditasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komoditas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('nama');
            $table->text('deskripsi');
            $table->string('foto');
            $table->string('tinggi')->nullable();
            $table->integer('ph')->nullable();
            $table->string('jenistanah')->nullable();
            $table->string('kelembaban')->nullable();
            $table->string('musim')->nullable();
            $table->integer('suhu')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komoditas');
    }
}