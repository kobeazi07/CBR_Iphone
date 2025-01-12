<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisModel extends Model
{
    use HasFactory;
    
    protected $table ='jenis_kerusakan';
    protected $guarded =[];

    // public function produk(){
    //     return $this->hasMany(Produk::class, 'kategori_id','id');
    // }
//  public function ciriCiri()
//     {
//         return $this->belongsTo(CiriCiriKerusakan::class, 'id_kerusakan');
//     }
     public function ciriCiri()
    {
        return $this->hasMany(CiriCiriKerusakan::class, 'id_kerusakan');
    }
}
