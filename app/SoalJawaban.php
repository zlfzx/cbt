<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoalJawaban extends Model
{
    protected $table = 'soal_jawaban';

    public function soal() {
        return $this->belongsTo('App\Soal');
    }
}
