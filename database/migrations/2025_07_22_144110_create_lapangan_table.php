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
       Schema::create('lapangan', function (Blueprint $table) {
            $table->id();
            $table->string('nm_lapangan', 100);
            $table->string('alamat', 255);
            $table->string('harga', 100);
            $table->text('fasilitas');
            $table->time('jam_buka_operasional');
            $table->time('jam_tutup_operasional');
            $table->string('foto', 255);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jenis_olahraga_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('jenis_olahraga_id')->references('id')->on('jenis_olahraga');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lapangan');
    }
};
