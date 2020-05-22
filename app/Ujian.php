<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';

    public function kelas() {
        return $this->belongsTo('App\Kelas');
    }

    public function paket_soal() {
        return $this->belongsTo('App\PaketSoal');
    }

    public function ujian_siswa() {
        return $this->hasMany('App\UjianSiswa');
    }
}
