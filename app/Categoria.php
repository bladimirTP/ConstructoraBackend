<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //use Notifiable;
    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "categoria";
    protected $primaryKey = 'id_categoria';
    public $timestamps= false;


    protected $fillable = [
        'nombre',
        'estado',

    ];
}
