<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function paket_soal() {
        return $this->belongsTo(PaketSoal::class);
    }

    public function ujian_siswa() {
        return $this->hasMany(UjianSiswa::class);
    }
}
