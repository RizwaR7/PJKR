<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'id',
        'judul',
        'isi',
        'id_sms',
        'ts',
        'tampil',
        'setuju',
        'id_admin',
        'lengket',
        'caption',
        'hapus',
        'domain',
        'kategori',
        'counter',
        'infopenting'
    ];
    public $timestamps = false;



}
