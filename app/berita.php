<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berita extends Model
{
    protected $fillable=['thumbnail', 'isiBerita', 'title', 'slug', 'lable', 'postedAt'];
    public $timestamps = false;
}
