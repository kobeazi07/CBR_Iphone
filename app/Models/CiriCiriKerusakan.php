<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiriCiriKerusakan extends Model
{
   use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi Laravel
    protected $table = 'ciri_kerusakan';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_kerusakan',
        'kode',
        'ciri_ciri',
        'bobot',
    ];

    //    public function RjenisKerusakan()
    // {
    //     return $this->hasMany(JenisModel::class, 'id_kerusakan');
    // }
     public function RjenisKerusakan()
    {
        return $this->belongsTo(JenisModel::class, 'id_kerusakan');
    }
}
