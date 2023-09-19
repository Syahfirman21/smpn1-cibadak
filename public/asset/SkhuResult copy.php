<?php

namespace App\Model\Ppdb;

use Illuminate\Database\Eloquent\Model;

class SkhuResult extends Model
{
    protected $table = "ppdb_skhu_results";
    public $timestamps = false;
    protected $guarded = ["id"];
}
