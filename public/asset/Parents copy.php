<?php

namespace App\Model\Ppdb;

use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    protected $table = "ppdb_parents";
    public $timestamps = false;
    protected $guarded = ["id"];
}
