<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $table = 'fm';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_sms',
        'dir',
        'nama',
        'asli',
        'ukuran',
        'domain',
        'tanggal',
        'iduser',
        'mime',
    ];
    public $timestamps = false;
}
