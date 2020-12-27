<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

// class Siswa extends Model
class Siswa extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'siswa';

     protected $hidden = ['password'];

    protected $fillable = ['nama', 'nis', 'password', 'kelas_id'];

    public function getJWTIdentifier()
    {
      return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
      return [];
    }

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }

    public function ujian_siswa() {
        return $this->hasMany(UjianSiswa::class);
    }

//    public function generateToken() {
//        $this->api_token = Str::random(60);
//        $this->save();
//        return $this->api_token;
//    }
}
