<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable=['img', 'galcategory_id'];
    public $timestamps = false;

    public function Galcategory() {
    	return $this->belongsTo('App\Galcategory');
    }
}
