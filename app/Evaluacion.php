<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{

    use Notifiable;

    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "evaluacion";
    protected $primaryKey = 'id_evaluacion';
    public $timestamps= false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'descripcion',
        'tipo',
    ];

    public function cuestionario(){
        return $this->hasMany(Cuestionario::class,'fkid_evaluacion','id_evaluacion');
    }
}
