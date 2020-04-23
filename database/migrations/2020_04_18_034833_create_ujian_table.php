<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUjianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('kelas_id')->unsigned()->nullable();
            $table->bigInteger('paket_soal_id')->unsigned()->nullable();
            $table->string('nama')->default('text');
            $table->string('keterangan')->nullable()->default('keterangan');
            $table->timestamp('waktu_mulai');
            $table->smallInteger('waktu_ujian')->default(60);
            $table->string('token', 50)->nullable()->default('token');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            $table->foreign('paket_soal_id')->references('id')->on('paket_soal')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ujian');
    }
}
