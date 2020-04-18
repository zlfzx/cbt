<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('paket_soal_id')->unsigned();
            $table->enum('jenis', ['pilihan_ganda', 'essai']);
            $table->string('nama')->nullable();
            $table->text('soal');
            $table->string('soal_media')->nullable();
            $table->bigInteger('kelas_id')->unsigned();
            $table->bigInteger('mapel_id')->unsigned();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('mapel_id')->references('id')->on('mata_pelajaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal');
    }
}
