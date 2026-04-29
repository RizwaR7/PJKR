<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';
    protected $fillable = [
        'id',
        'isi',
        'judul',
        'isi',
        'ts', //tanggal input (unix datestamp)
        'tampil',
        'kategori',
        'lengket',
        'counters',
        'caption',
        'id_sms',
        'id_admin',
        'setuju',
        'hapus',
        'domain',
        'foto_berita'
    ];
    public $timestamps = false;
}
