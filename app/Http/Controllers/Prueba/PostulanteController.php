<?php

namespace App\Http\Controllers\Prueba;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Personal;
use DB;

class PostulanteController extends ApiController
{
    public function index()
    {
         try {
            $postulante=DB::table('personal as p')
            ->join('prueba as pru','pru.fkid_personal','=','p.id_personal')->select('nombre','apellido','cedula','edad','dedicacion','pru.estado')
            ->where('pru.estado','=','en revision')
            ->orwhere('pru.estado','=','reprobado')
            ->get();
            return $this->showAll($postulante);
         } catch (\Throwable $th) {
             return $this->errorResponse($th->getMessage(),422); //codigo signica solicitud no procesable

         }
    }
}
