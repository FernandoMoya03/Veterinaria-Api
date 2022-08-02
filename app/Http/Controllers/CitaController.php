<?php

namespace App\Http\Controllers;
use App\ClienteModel;
use App\MascotasModel;
use App\ServicioModel;
use App\CitasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class CitaController extends Controller
{
    
    public function index()
    {
        if($id = null)
        return response()->json(["Cita"=>CitasModel::find($id)],200);
        return response()->json(["Citas"=>CitasModel::all()],200);
    }

    public function indexCompleto(){

        $citas = DB::table('citas')
        ->join('clientes', 'clientes.id', '=' , 'citas.cliente')
        ->join('mascotas','mascotas.id','=','citas.mascota')
        ->select('citas.id as id_cita','clientes.nombre as Cliente')
        ->get();

        return response()->json($citas);

    }

    
    public function create(Request $request)
    {
        if($request->mascota == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la mascota'],400); 
        }
        elseif($request->cliente == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el cliente'],400); 
        }
        elseif($request->veterinario == "")
        {
            return response()->json(['messeage' => 'Favor de insertar veterinario'],400); 
        }
        elseif($request->fecha == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la fecha'],400); 
        }
        elseif($request->status == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el status'],400); 
        }

        $citas = new CitasModel();
        $citas->mascota = $request->mascota;
        $citas->cliente = $request->cliente;
        $citas->servicio = $request->servicio;
        $citas->veterinario = $request->veterinario;
        $citas->fecha = $request->fecha;
        $citas->status = $request->status;

        if($citas->save())
        return response()->json(["Se ha agregado el servicio con exito!!!"],200);
        return response()->json(null,400);
    }


    public function update(Request $request, $id)
    {
        $results = DB::select('select * from citas where id = :id', ['id' => $id]);
       

        if($results==[])
        {
            return response()->json(["No existe el id de la cita"]);
        }
        else
        {
            if($request->mascota == "")
            {
                return response()->json(['messeage' => 'Favor de insertar la mascota'],400); 
            }
            elseif($request->cliente == "")
            {
                return response()->json(['messeage' => 'Favor de insertar el cliente'],400); 
            }
            elseif($request->veterinario == "")
            {
                return response()->json(['messeage' => 'Favor de insertar veterinario'],400); 
            }
            elseif($request->fecha == "")
            {
                return response()->json(['messeage' => 'Favor de insertar la fecha'],400); 
            }
            elseif($request->status == "")
            {
                return response()->json(['messeage' => 'Favor de insertar el status'],400); 
            }

            
        $update = new CitasModel();
        $update = CitasModel::find($id);
        $update->mascota = $request->get('mascota');
        $update->cliente = $request->get('cliente');
        $update->servicio = $request->get('servicio');
        $update->veterinario = $request->get('veterinario');
        $update->fecha = $request->get('fecha');
        $update->status = $request->get('status');
        
        if($update->save())
        return response()->json(["Se ha actualizado la cita exitosamente"],200);
        }
    }

    public function destroy($id)
    {
        CitasModel::destroy($id);
        return response()->json(["Se ha eliminado el servicio exitosamente"],200);
    }
}
