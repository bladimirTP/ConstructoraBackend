<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{

    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "cita";
    protected $primaryKey = 'id_cita';
    public $timestamps= false;


    protected $fillable = [
        'fecha',
        'descripcion',
        'fkid_obra',

    ];
    public function manoobra()
    {
        return $this->belongsTo(Mano_obra::class, 'fkid_obra','id_obra');
    }


}
