<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{

    use Notifiable;

    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "respuesta";
    protected $primaryKey = 'id_respuesta';
    public $timestamps= false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'respuesta',
        'fkid_prueba',
        'fkid_cuestionario',
    ];
    public function prueba()
    {
        return $this->belongsTo(Prueba::class, 'fkid_prueba','id_prueba');
    }

    public function cuestionario()
    {
        return $this->belongsTo(Cuestionario::class, 'fkid_cuestionario','id_cuestionario');
    }
}
