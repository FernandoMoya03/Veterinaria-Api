<?php

namespace App\Http\Controllers;


use App\ClienteModel;
use App\MascotasModel;
use App\ServicioModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    
    public function index($id = null)
    {
        if($id)
        return response()->json(["Servicio"=>ServicioModel::find($id)],200);
        return response()->json(["Servicios"=>ServicioModel::all()],200);
    }

    
    public function create(Request $request)
    {
        if($request->servicio == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el servicio'],400); 
        }
        elseif($request->descripcion == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la descripcion'],400); 
        }

        $servicio = new ServicioModel();
        $servicio->servicio = $request->servicio;
        $servicio->descripcion = $request->descripcion;

        if($servicio->save())
        return response()->json(["Se ha agregado el servicio con exito!!!"],200);
        return response()->json(null,400);
    }

   
    public function update(Request $request, $id)
    {
        
        $results = DB::select('select * from servicios where id = :id', ['id' => $id]);
       

        if($results==[])
        {
            return response()->json(["No existe el Id del servicio"]);
        }
        else
        {
            
            if($request->servicio == "")
            {
                return response()->json(['messeage' => 'Favor de insertar servicio'],400); 
            }
            elseif($request->descripcion == "")
            {
                return response()->json(['messeage' => 'Favor de insertar descripcion'],400); 
            }
           

            
        $update = new ServicioModel();
        $update = ServicioModel::find($id);
        $update->servicio = $request->get('servicio');
        $update->descripcion = $request->get('descripcion');
        
        if($update->save())
        return response()->json(["Se ha actualizado el servicio exitosamente"],200);
        }
    }

   
    public function destroy($id)
    {
        ServicioModel::destroy($id);
        return response()->json(["Se ha eliminado el servicio exitosamente"],200);
    }
}
