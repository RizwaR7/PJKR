<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_fak extends Model
{
    use HasFactory;

    protected $table = 'm_fak';

    protected $primaryKey = 'id_fak';


    public $timestamps = false;


    public $incrementing = true;


}
