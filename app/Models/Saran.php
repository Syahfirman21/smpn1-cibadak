<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
    protected $fillable = ['nama', 'email', 'pesan'];

    // Tambahkan relasi atau metode lain jika diperlukan
}
