<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mata_pelajaran';

    protected $fillable = ['nama'];
}
