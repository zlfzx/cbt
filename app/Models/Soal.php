<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';

    protected $fillable = [
      'kelas_id',
      'mapel_id',
      'paket_soal_id',
      'jenis',
      'nama',
      'soal',
      'media'
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel() {
        return $this->belongsTo(Mapel::class);
    }

    public function paket_soal() {
        return $this->belongsTo(PaketSoal::class);
    }

    public function soal_jawaban() {
        return $this->hasMany(SoalJawaban::class);
    }
}
