<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo_obra extends Model
{

    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "tipo_obra";
    protected $primaryKey = 'id_tipo';
    public $timestamps= false;


    protected $fillable = [
        'nombre',
    ];
    public function manoobra(){
        return $this->hasOne(Mano_obra::class,'fkid_tipo','id_tipo');
    }
}
