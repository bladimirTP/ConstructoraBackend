<?php

namespace App\Http\Controllers\Obra;
 use App\Mano_obra;
 use App\Detalle_obra;
 use App\Ubicacion;
 use App\Cita;
 use App\User;
 use App\Http\Controllers\Controller;
 use App\Http\Controllers\ApiController;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Input;
 use DB;

class ManodeobraController extends ApiController
{


         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         try {
            $obra = Mano_obra::select('id_obra','direccion','fecha','estado_pago','tipo','estado')->get();
            return $this->showAll($obra);
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
            DB::beginTransaction();
            $obra = new Mano_obra();
            $obra->direccion = $request->get('direccion');
            $obra->estado = $request->get('estado');
            $obra->estado_pago = $request->get('estado_pago');
            $obra->fecha = $request->get('fecha');
            $obra->descripcion = $request->get('descripcion');
            $obra->tipo = $request->get('tipo');
            $obra->fkid_pago = $request->get('fkid_pago');
            $obra->fkid_usuario = $request->get('fkid_usuario');

            $nombre=User::find($request->fkid_usuario,['nombre']);
            $var='obra';

            $obra->save();

            $detalle = $request->get('detalle');

            //dd($detalle);
            foreach ($detalle as $deta) {
                $detalle_obra = new Detalle_obra();
                $detalle_obra->fkid_obra = $obra->id_obra;
                $detalle_obra->fkid_servicio = $deta['fkid_servicio'];
                $detalle_obra->costo_obra = $deta['costo_obra'];
                $detalle_obra->cantidad = $deta['cantidad'];
                $detalle_obra->unidad = $deta['unidad'];

                if(!$request->has($deta['foto'])){
                    $detalle_obra->foto = $deta['foto'];
                   // $file->move(public_path()."/imagenes/$var/$nombre",$file->getClientOriginalName());
                   // $detalle_obra->foto = $file->getClientOriginalName();
                  }
                $detalle_obra->save();
            }

            if ($request->ubicacion) {
                $ubic=$request->get('ubicacion');
                foreach ($ubic as $value) {
                    $ubicacion = new  Ubicacion();
                    $ubicacion->fkid_obra = $obra->id_obra;
                    $ubicacion->longitud = $value->get('longitud');
                    $ubicacion->latitud = $value->get('latitud');
                    $ubicacion->save();
                }

            }

            if ($request->cita) {
                $citas=$request->get('cita');
                foreach ($citas as $cit) {
                    $cita = new  Cita();
                    $cita->fkid_obra = $obra->id_obra;
                    $cita->fecha = $cit->get('fecha');
                    $cita->descripcion = $cit->get('descripcion');

                }
                $citat->save();
            }
            DB::commit();
            return $this->showOne($obra);
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
    public function show($obra)
    {
        try {
            $obra=DB::table('mano_obra as obr')
            ->join('users as use','obr.fkid_usuario','=','use.id_usuario')
            ->join('forma_pago as p','obr.fkid_pago','=','p.id_pago')
            ->select('use.nombre','use.apellido','obr.tipo','p.forma')
            ->where('obr.id_obra','=',$obra)
            ->get();

             return $this->showAll($obra, 201);
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
