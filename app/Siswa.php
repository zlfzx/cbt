<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

// class Siswa extends Model
class Siswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'siswa';

    // protected $hidden = ['password'];

    protected $fillable = ['nama', 'nis', 'password', 'kelas_id'];

    public function kelas() {
        return $this->belongsTo('App\Kelas');
    }

    public function ujian_siswa() {
        return $this->hasMany('App\UjianSiswa');
    }

    public function generateToken() {
        $this->api_token = Str::random(60);
        $this->save();
        return $this->api_token;
    }
}
