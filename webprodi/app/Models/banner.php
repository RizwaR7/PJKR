<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class banner extends Model
{
    use HasFactory;

    protected $table = "banner";
    protected $fillable = [
        'id',
        'id_sms',
        'filegambar',
        'url',
        'nomor',
        'grup',
        'domain',
        'besar',
        'ukuran',
        'tampil'];

    public $timestamps = false;
}
