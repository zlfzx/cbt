<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = ['nama', 'nis', 'password', 'kelas_id'];

    public function kelas() {
        return $this->belongsTo('App\Kelas');
    }
}
