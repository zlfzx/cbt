<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    protected $table = 'paket_soal';

    protected $fillable = ['nama', 'keterangan', 'kelas_id', 'mapel_id', 'kode_paket'];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel() {
        return $this->belongsTo(Mapel::class);
    }

    public function soal() {
        return $this->hasMany(Soal::class);
    }

    public function ujian() {
        return $this->hasMany(Ujian::class);
    }
}
