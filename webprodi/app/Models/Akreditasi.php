<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ps';
    protected $table = 'm_ps';

    protected $fillable = [
        'id_ps',
        'nm_ps',
        'strata',
        'akre',
        'no_sk',
        'ts_sk',
        'ts_berlaku',
        'foto_akreditasi'
    ];


    public $timestamps = false;
}
