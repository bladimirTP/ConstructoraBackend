<?php

namespace App\Http\Controllers\obra;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use DB;

class DetalleObraController extends ApiController
{
    public function show($obra)
    {
        try {
            $obra=DB::table('mano_obra as obr')
            ->join('detalle_obra as detalle','detalle.fkid_obra','=','obr.id_obra')
            ->join('servicio as serv','detalle.fkid_servicio','=','serv.id_servicio')
            ->select('serv.nombre','detalle.cantidad','detalle.cantidad','detalle.unidad','detalle.costo_obra','detalle.foto')
            ->where('obr.id_obra','=',$obra)
            ->get();
             return $this->showAll($obra, 201);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),422);
        }
    }

}
