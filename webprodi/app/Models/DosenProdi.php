<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenProdi extends Model
{
    use HasFactory;
    protected $table = 'dosen_ps';
    protected $primaryKey = 'id_dosen_ps';
    public $timestamps = false;

    public function Detail()
    {
        return $this->hasOne(DetailPimpinan::class, 'id_dosen');
    }
}
