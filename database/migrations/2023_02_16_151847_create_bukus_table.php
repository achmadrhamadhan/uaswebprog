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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengarang_id');
            $table->unsignedBigInteger('penerbit_id');
            $table->enum('status',['available','rented','broken']);
            $table->string('nama');
            $table->enum('genre',['novel','fiksi','self-improvement','religi','bisnis']);
            $table->integer('tahun');
            $table->longText('sinopsis');
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
        Schema::dropIfExists('bukus');
    }
};
