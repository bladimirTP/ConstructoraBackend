<?php

namespace App\Http\Controllers\Pago;
use App\Forma_pago;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class PagoController extends ApiController
{
           /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
            $pago= Forma_pago::all();
            return $this->showAll($pago);
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
                'forma' => 'required',
                'descripcion'=>'required',
                'estado'=>'required',
            ];
            $this->validate($request,$reglas);
            $pago = Forma_pago::create($request->all());
            return $this->showOne($pago, 201);
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
    public function show(Forma_pago $pago)
    {
        try {
            return $this->showOne($pago, 201);
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
    public function update(Request $request, Forma_pago $pago)
    {
        try {
               $pago->update($request->all());
               return $this->showOne($pago, 201);
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
    public function destroy(Forma_pago $pago)
    {
         try {
            $pago->estado= Forma_pago::DESACTIVAR;
            $pago->update();
            return  $this->showOne($pago);
         } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),422);
         }

    }
}
