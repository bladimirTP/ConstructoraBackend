<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    //use Notifiable;

    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "prueba";
    protected $primaryKey = 'id_prueba';
    public $timestamps= false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estado',
        'fkid_personal'

    ];


        public function personal()
        {
            return $this->belongsTo(Personal::class, 'fkid_personal','id_personal');
        }
        public function cuestionario()
        {
            return $this->belongsToMany(Cuestionario::class, 'respuesta', 'fkid_prueba', 'fkid_cuestionario');
        }
}
