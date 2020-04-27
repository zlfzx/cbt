<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';

    public function kelas() {
        return $this->belongsTo('App\Kelas');
    }

    public function mapel() {
        return $this->belongsTo('App\Mapel');
    }

    public function paket_soal() {
        return $this->belongsTo('App\PaketSoal');
    }

    public function soal_jawaban() {
        return $this->hasMany('App\SoalJawaban');
    }
}
