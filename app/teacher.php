<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    protected $fillable = ['thumbnail', 'nama', 'nip', 'mapel'];
    public $timestamps = false;
}
