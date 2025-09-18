<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus'; 

    protected $fillable = [
        'nip',
        'nama',
        'jenkel',
        'tgl_lahir',
        'alamat',
        'email',
        'no_telp',
        'status'
    ];

    protected $casts = [
        'tgl_lahir' => 'date', 
    ];
}
