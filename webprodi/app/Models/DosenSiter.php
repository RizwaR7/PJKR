<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenSiter extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'dosen_siter';
    protected $primaryKey = 'id_dosen';

    protected $fillable = [
        'id_dosen',
        'nidn',
        'nip',
        'nik',
        'nama_dosen',
        'jenis_kelamin',
        'jns_sdm',
        'nama_ikatan_kerja',
        'fakultas',
        'nama_program_studi',
        'nama_golongan',
        'email',
        'email_sister',
        'status_keaktifan',
        'status_kepegawaian',
        'scholar_id',
        'sinta_id',
        'sister_id',
        'foto_dosen'
    ];

    public $timestamps = false;
}
