<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    protected $table = 'paket_soal';

    protected $fillable = ['nama', 'keterangan', 'kelas_id', 'mapel_id'];

    public function kelas() {
        return $this->belongsTo('App\Kelas');
    }

    public function mapel() {
        return $this->belongsTo('App\Mapel');
    }
}
