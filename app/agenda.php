<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class agenda extends Model
{
   	protected $fillable = ['thumbAgenda', 'descAgenda', 'titleAgenda', 'slug', 'tglMulai', 'tglAkhir', 'jamMulai', 'jamSelesai', 'tempat'];
   	public $timestamps = false;
}
