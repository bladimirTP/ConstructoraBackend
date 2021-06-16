<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "ubicacion";
    protected $primaryKey = 'id_ubicacion';
    public $timestamps= false;


    protected $fillable = [
        'latitud',
        'longitud',
        'fkid_obra',

    ];
    public function manoobra()
    {
        return $this->belongsTo(Mano_obra::class, 'fkid_obra','id_obra');
    }
}
