<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $primaryKey = 'idmenu';

    protected $fillable = [
        'idmenu',
        'nama',
        'induk',
        'urut',
        'url',
        'aktif',
        'simbol',
        'newtab',
        'id_sms'
    ];

    public $timestamps = false;



    public static function getMenu()
    {
        return self::where('id_sms', (int)env('PRODI_ID'))->where('induk', 0)->where('aktif', 1)->orderBy('urut', 'asc')->get();
    }

    public function submenus()
    {
        return $this->hasMany(Menu::class, 'induk', 'idmenu')->orderBy('urut', 'asc');
    }
}
