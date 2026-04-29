<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPimpinan extends Model
{
    use HasFactory;
    protected $table = 'dosen_siter';
    protected $primaryKey = 'id_dosen';


    public function DetailPimpinan()
    {
        return $this->belongsTo(Pimpinan::class, 'id_dosen', 'id_dosen');
    }

    public function DosenProdi(){
        return $this->belongsTo(DosenProdi::class, 'id_dosen', 'id_ptk');
    }
}
