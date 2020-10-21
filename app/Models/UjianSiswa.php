<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UjianSiswa extends Model
{
    protected $table = 'ujian_siswa';

    public function siswa() {
        return $this->belongsTo(Siswa::class);
    }

    public function ujian() {
        return $this->belongsTo(Ujian::class);
    }
}
