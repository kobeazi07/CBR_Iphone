<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HdiagnosasModel extends Model
{
    use HasFactory;
     protected $table ='hdiagnosas';
    protected $guarded =[];

     public function gdiagnosas()
    {
        return $this->belongsTo(GdiagnosasModel::class, 'diagnosas_id');
    }
}
