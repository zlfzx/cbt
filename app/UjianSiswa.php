<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UjianSiswa extends Model
{
    protected $table = 'ujian_siswa';

    public function siswa() {
        return $this->belongsTo('App\Siswa');
    }

    public function ujian() {
        return $this->belongsTo('App\Ujian');
    }
}
