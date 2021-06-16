<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{


    //use Notifiable;

    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "personal";
    protected $primaryKey = 'id_personal';
    public $timestamps= false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'cedula',
        'edad',
        'dedicacion',
    ];

    public function prueba(){
        return $this->hasMany(Prueba::class,'fkid_personal','id_personal');
    }

}
