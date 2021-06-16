<?php

namespace App\Http\Controllers\Servicio;
use App\Servicio;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class ServicioController extends ApiController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
            $servicio= Servicio::all();
            return $this->showAll($servicio);
         } catch (\Throwable $th) {
             return $this->errorResponse($th->getMessage(),422); //codigo signica solicitud no procesable

         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $reglas = [
                'nombre' => 'required',
                'costo'=>'required',
                'descripcion'=>'required',
            ];
            $this->validate($request,$reglas);
            $servicio = Servicio::create($request->all());
            return $this->showOne($servicio, 201);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicio)
    {
        try {
            return $this->showOne($servicio, 201);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicio)
    {
        try {
               $servicio->update($request->all());
               return $this->showOne($servicio, 201);
        } catch (\Throwable $th) {
               return $this->errorResponse($th->getMessage(),422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicio)
    {
         try {
            $servicio->estado= Servicio::DESACTIVAR;
            $servicio->update();
            return  $this->showOne($servicio);
         } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),422);
         }

    }
}
