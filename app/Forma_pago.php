<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forma_pago extends Model
{

    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "forma_pago";
    protected $primaryKey = 'id_pago';
    public $timestamps= false;


    protected $fillable = [
        'forma',
        'descripcion',
        'estado',
    ];

    public function manoobra(){
        return $this->hasOne(Mano_obra::class,'fkid_pago','id_pago');
    }

}
