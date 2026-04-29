<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_video extends Model
{
    use HasFactory;

    protected $table = 'm_video';

    protected $primaryKey = 'id';


    public $timestamps = false;


    public $incrementing = true;

    protected $fillable = [
        'id',
        'name',
        'url',
        'desc',
        'id_ps',
    ];


}
