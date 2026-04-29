<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $fillable = [
        'id',
        'id_sms',
        'judul',
        'isi',
        'id_admin',
        'ts',
        'tampil',
        'kategori',
        'lengket',
        'infopenting',
        'tgl_input',
        'id2',
        'counters',
        'caption',
        'setuju',
        'hapus',
        'domain',
        'caption',
        'foto_berita',
    ];

    public $timestamps = false;


}
