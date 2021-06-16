<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{

    use Notifiable;

    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "cuestionario";
    protected $primaryKey = 'id_cuestionario';
    public $timestamps= false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pregunta',
        'fkid_evaluacion',

    ];
       public function evaluacion()
        {
            return $this->belongsTo(Evaluacion::class, 'fkid_evaluacion','id_evaluacion');
        }
        public function prueba()
        {
            return $this->belongsToMany(Prueba::class, 'respuesta', 'fkid_cuestionario', 'fkid_prueba');
        }
}
