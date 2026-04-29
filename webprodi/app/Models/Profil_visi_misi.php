<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profil_visi_misi extends Model
{
    use HasFactory;


    protected $table = 'profil';

    public $timestamps = false;

    public $fillable = [
        'id_sms',
        'isi',
        'jenis',
        'id_user'
    ];
}
