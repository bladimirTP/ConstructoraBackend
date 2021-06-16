<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotografia extends Model
{

    const ACTIVAR= 'activo';
    const DESACTIVAR='inactivo';
    protected $table = "fotografia";
    protected $primaryKey = 'id_foto';
    public $timestamps= false;


    protected $fillable = [
        'foto',
        'fkid_obra',

    ];

    public function obra()
    {
        return $this->belongsTo(Mano_obra::class, 'fkid_obra','id_obra');
    }
}
