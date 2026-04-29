<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $table = 'footers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama',
        'urut',
        'url',
        'aktif',
        'jenis',
        'newtab',
        "id_ps",
        "icon_key"
    ];

    public $timestamps = false;
}
