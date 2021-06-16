<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_obra extends Model
{
    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "detalle_obra";
    protected $primaryKey = 'id_detalle';
    public $timestamps= false;


    protected $fillable = [
        'fkid_obra',
        'fkid_servicio',
        'costo_obra',
        'cantidad',
        'unidad',
        'foto',

    ];

    public function mano_obra()
    {
        return $this->belongsTo(Mano_obra::class, 'fkid_obra','id_obra');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'fkid_servicio','id_servicio');
    }
}
