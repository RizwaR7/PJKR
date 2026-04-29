<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;


    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'status',
        'id_induk',
        'id_sms',
    ];

    public $timestamps = false;

}
