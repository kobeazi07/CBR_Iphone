<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GdiagnosasModel extends Model
{
    use HasFactory;
    protected $table ='gdiagnosas';
    protected $guarded =[];

     public function Rgdiagnosas()
    {
        return $this->hasMany(HdiagnosasModel::class, 'diagnosas_id');
    }
    

}
