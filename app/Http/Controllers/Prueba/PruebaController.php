<?php

namespace App\Http\Controllers\Prueba;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Personal;
use Illuminate\Http\Request;
use App\Prueba;
use App\Respuesta;
use Illuminate\Support\Facades\DB;

class PruebaController extends ApiController
{
    public function index()
    {
        try {
            $usuarios = Prueba::with('personal')->where('estado', 'aprobado')->get();
            return $this->showAll($usuarios);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(), 422); //codigo signica solicitud no procesable

        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $personalSave = $this->savePersonal($request->personal);
            $pruebaSave = $this->savePrueba($personalSave);
            $this->saveRespuestasCuestionario($request->respuestas, $pruebaSave);
            DB::commit();
            return $this->showOne($pruebaSave, 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorResponse($th->getMessage(), 422);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $prueba=Prueba::find($id);
            $prueba->update($request->all());
            return $this->showOne($prueba, 201);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),422);
        }
    }

    public function savePersonal($personalData)
    {
        $personal = new Personal();
        $personal->nombre = $personalData["nombre"];
        $personal->apellido = $personalData["apellido"];
        $personal->cedula = $personalData["cedula"];
        $personal->edad = $personalData["edad"];
        $personal->dedicacion = $personalData["dedicacion"];
        $personal->save();
        return $personal;
    }

    public function savePrueba($personalData)
    {
        $prueba = new Prueba();
        $prueba->estado = "en revision";
        $prueba->fkid_personal = $personalData->id_personal;
        $prueba->save();
        return $prueba;
    }

    public function saveRespuestasCuestionario($respuestas, $prueba)
    {
        foreach ($respuestas as $value) {
            $respuesta = new Respuesta();
            $respuesta->respuesta = $value["respuesta"];
            $respuesta->fkid_cuestionario = $value["fkid_cuestionario"];
            $respuesta->fkid_prueba = $prueba->id_prueba;
            $respuesta->save();
        }
    }
}
