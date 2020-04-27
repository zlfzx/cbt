<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = ['nama'];

    public function paket_soal() {
        return $this->hasMany('App\PaketSoal');
    }

    public function soal() {
        return $this->hasMany('App\Soal');
    }
}
