<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mano_obra extends Model
{
    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "mano_obra";
    protected $primaryKey = 'id_obra';
    public $timestamps= false;


    protected $fillable = [
        'direccion',
        'estado',
        'estado_pago',
        'fecha',
        'foto',
        'descripcion',
        'fkid_tipo',
        'fkid_pago',
    ];


    public function cita(){
        return $this->hasMany(Cita::class,'fkid_obra','id_obra');
    }
    public function ubicacion(){
        return $this->hasMany(Ubicacion::class,'fkid_obra','id_obra');
    }

    public function tipo_obra()
    {
        return $this->belongsTo(Tipo_obra::class, 'fkid_tipo','id_tipo');
    }
    public function forma_pago()
    {
        return $this->belongsTo(Forma_pago::class, 'fkid_pago','id_pago');
    }

    //mucho a muchos

    public function servicio()
    {
        return $this->belongsToMany(Servicio::class, 'detalle_obra', 'fkid_obra', 'fkid_servicio');
    }

    public function fotografia(){
        return $this->hasMany(Fotografia::class,'fkid_obra','id_obra');
    }


}
