<?php

namespace App\Http\Controllers\Categoria;
use App\Categoria;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CategoriaController extends  ApiController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
            $categoria= Categoria::all();
            return $this->showAll($categoria);
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
            ];
            $this->validate($request,$reglas);
            $categoria = Categoria::create($request->all());
            return $this->showOne($categoria, 201);
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
    public function show(Categoria $categoria)
    {
        try {
            return $this->showOne($categoria, 201);
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
    public function update(Request $request, Categoria $categoria)
    {
        try {
               $categoria->update($request->all());
               return $this->showOne($categoria, 201);
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
    public function destroy(Categoria $categoria)
    {
         try {
            $categoria->estado= Categoria::DESACTIVAR;
            $categoria->update();
            return  $this->showOne($categoria);
         } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),422);
         }

    }
}
