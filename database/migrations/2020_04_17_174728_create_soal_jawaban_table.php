<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_jawaban', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('soal_id')->unsigned();
            $table->text('jawaban')->default('text');
            $table->string('jawaban_media')->nullable();
            $table->enum('status', ['1', '0'])->default('0');
            $table->timestamps();

            $table->foreign('soal_id')->references('id')->on('soal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal_jawaban');
    }
}
