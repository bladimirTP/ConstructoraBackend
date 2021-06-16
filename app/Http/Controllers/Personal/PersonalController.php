<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
 use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Personal;
use DB;

class PersonalController extends ApiController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // aqui
         try {
            $personal=DB::table('personal as p')
            ->join('prueba as pru','pru.fkid_personal','=','p.id_personal')->select('nombre','apellido','cedula','edad','dedicacion','pru.estado')
            ->where('pru.estado','=','aprobado')
            ->get();
            return $this->showAll($personal);
         } catch (\Throwable $th) {
             return $this->errorResponse($th->getMessage(),422); //codigo signica solicitud no procesable

         }
    }
}
