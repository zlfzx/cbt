<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = ['nama'];

    public function siswa() {
        return $this->hasMany(Siswa::class);
    }

    public function paket_soal() {
        return $this->hasMany(PaketSoal::class);
    }

    public function soal() {
        return $this->hasMany(Soal::class);
    }

    public function ujian() {
        return hasMany(Ujian::class);
    }
}
