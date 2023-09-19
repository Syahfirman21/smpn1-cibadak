<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galcategory extends Model
{
    protected $fillable=['kategori'];

    public $timestamps = false;

    public function galleries() {
    	return $this->hasMany('App\Gallery');
    }
}
