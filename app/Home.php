<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable=['profile', 'welcome', 'profileSekolah', 'contact', 'embed', 'about', 'fblink', 'twtlink', 'gpluslink'];
    public $timestamps = false;
}
