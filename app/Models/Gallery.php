<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['judul', 'deskripsi', 'gambar'];

    // Tambahkan relasi atau metode lain jika diperlukan
}
