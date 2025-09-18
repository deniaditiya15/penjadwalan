<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    protected $fillable = [
        'kelas_id',
        'mapel_id',
        'guru_id',
        'hari',
        'waktu_mulai',
        'waktu_selesai',
        'semester',
    ];

    // Relasi
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class); // sebelumnya Mapels::class
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class); // sebelumnya Gurus::class
    }
}
