<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    public $timestamps = false; // Tidak ada kolom created_at dan updated_at

    protected $fillable = [
        'profile',
        'profileSekolah',
        // Kolom-kolom lain yang perlu dimasukkan ke dalam mass assignment juga
    ];

    // ...
}
