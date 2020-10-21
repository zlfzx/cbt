<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoalJawaban extends Model
{
    protected $table = 'soal_jawaban';

    public function soal() {
        return $this->belongsTo(Soal::class);
    }
}
