<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujian';

    protected $fillable = ['kelas_id', 'paket_soal_id', 'nama', 'keterangan', 'waktu_mulai', 'waktu_ujian', 'token'];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function paket_soal() {
        return $this->belongsTo(PaketSoal::class)
          ->with('mapel:id,nama')
          ->withCount('soal');
    }

    public function ujian_siswa() {
        return $this->hasMany(UjianSiswa::class);
    }
}
