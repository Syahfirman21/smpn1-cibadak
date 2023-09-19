<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=['nama','nis','gender','kelas', 'class_id'];
    public $timestamps = false;
}
