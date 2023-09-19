<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['nama', 'npm', 'jurusan', 'angkatan'];

    // Tambahkan relasi atau metode lain jika diperlukan
}
