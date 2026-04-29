<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;
    protected $table = 'agenda';
    protected $primaryKey = 'id_kegiatan';

    protected $fillable = [
        'id_kegiatan',
        'id_sms',
        'judul_kegiatan',
        'isi_kegiatan',
        'ts',
        'tempat_kegiatan',
        'tampil',
        'counters',
    ];

    public $timestamps = false;
}
