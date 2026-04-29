<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;
    protected $table = 'pimpinan_ps';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_dosen',
        'id_sms',
        'jabatan',
        'no_sk_pim',
        'ts_sk_pim',
        'ts_berlaku_pim',
        'no_urut',
        'tampil',
        'foto_pimpinan',
    ];
    public $timestamps = false;
    public function Pimpinan()
    {
        return $this->hasOne(DetailPimpinan::class, 'id_dosen', 'id_dosen');
    }
}