<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // optional, default nama tabel plural
    protected $fillable = [
        'kelas',
        'nip',
        'nama_walikelas',
        'jumlah_siswa',
    ];
}
