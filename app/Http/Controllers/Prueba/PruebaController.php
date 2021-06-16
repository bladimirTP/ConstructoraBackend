<?php

namespace App\Http\Controllers\Prueba;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Prueba;

class PruebaController extends ApiController
{
    public function index()
    {
    try {
        $usuarios= Prueba::with('personal')->where('estado','aprobado')->get();
        return $this->showAll($usuarios);
     } catch (\Throwable $th) {
         return $this->errorResponse($th->getMessage(),422); //codigo signica solicitud no procesable

     }
     }
}
