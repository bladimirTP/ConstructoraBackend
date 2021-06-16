<?php

namespace App\Http\Controllers\User;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
            $usuarios= User::all();
            return $this->showAll($usuarios);
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
                'apellido'=>'required',
                'cedula'=>'required',
                'email'=>'required',
                'password'=>'required',

            ];
            if (User::where('email', $request->email)->exists()) {
                return response()->json(['data'=>'el email ya existe, elija otro email por favor']);
             }
            $this->validate($request,$reglas);
            $data= $request->all();
            $data['nombre']=$request->nombre;
            $data['apellido']=$request->apellido;
            $data['cedula']=$request->cedula;
            $data['email']=$request->email;
            $data['password']=Hash::make($request->password);
            $data['direccion']=$request->direccion;
            $data['telefono']=$request->telefono;
            $data['tipo']=$request->tipo;
            $data['estado']=User::ACTIVAR;
            $usuario=User::create($data);
            return $this->showOne($usuario, 201);
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
    public function show(User $user)
    {
        try {
            return $this->showOne($user, 201);
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
    public function update(Request $request, User $user)
    {
        try {
               $user->update($request->all());
               return $this->showOne($user, 201);
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
    public function destroy(User $user)
    {
         try {
            $user->estado= User::DESACTIVAR;
            $user->update();
            return  $this->showOne($user);
         } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage(),422);
         }

    }
}
