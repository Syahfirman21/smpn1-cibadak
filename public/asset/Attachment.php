<?php

namespace App\Model\Ppdb;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $table = "ppdb_attachments";
    protected $guarded = ["id"];
}
