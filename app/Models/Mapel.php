<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = ['nama'];

    public function paket_soal() {
        return $this->hasMany(PaketSoal::class);
    }

    public function soal() {
        return $this->hasMany(Soal::class);
    }
}
