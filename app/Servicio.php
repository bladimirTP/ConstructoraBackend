<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "servicio";
    protected $primaryKey = 'id_servicio';
    public $timestamps= false;


    protected $fillable = [
        'nombre',
        'costo',
        'descripcion',
        'estado',
    ];

    public function mano_obra()
    {
        return $this->belongsToMany(Mano_obra::class, 'detalle_obra', 'fkid_servicio', 'fkid_obra');
    }
}
