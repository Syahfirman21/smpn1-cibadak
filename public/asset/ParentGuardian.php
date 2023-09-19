<?php

namespace App\Model\Ppdb;

use Illuminate\Database\Eloquent\Model;

class ParentGuardian extends Model
{
    protected $table = "ppdb_parent_guardians";
    public $timestamps = false;
    protected $guarded = ["id"];
}
