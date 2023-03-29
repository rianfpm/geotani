<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->text('nama');
            $table->foreignId('kategori_id');
            $table->foreignId('user_id');
            $table->text('deskripsi');
            $table->string('foto');
            $table->integer('harga');
            $table->integer('stok');
            $table->integer('berat');
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
        Schema::dropIfExists('produks');
    }
}