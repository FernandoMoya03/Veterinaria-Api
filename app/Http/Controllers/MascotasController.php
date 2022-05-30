<?php

namespace App\Http\Controllers;

use App\ClienteModel;
use App\MascotasModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MascotasController extends Controller
{
   
    public function index($id = null)
    {
        if($id)
        return response()->json(["Mascota"=>MascotasModel::find($id)],200);
        return response()->json(["Mascotas"=>MascotasModel::all()],200);
    }

   
    public function create(Request $request)
    {
        if($request->nombre == "")
        {
            return response()->json(['messeage' => 'Favor de insertar Nombre'],400); 
        }
        elseif($request->raza == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el nombre de la Raza'],400); 
        }
        elseif($request->tipo == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el tipo de animal'],400); 
        }
        elseif($request->edad == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la edad correspondiente'],400); 
        }
        elseif($request->cliente == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el Id del cliente'],400); 
        }
        $user = new MascotasModel();
        $user->nombre = $request->nombre;
        $user->raza = $request->raza;
        $user->tipo = $request->tipo;
        $user->edad = $request->edad;
        $user->cliente = $request->cliente;

        if($user->save())
        return response()->json(["Se ha agregado el cliente con exito!!!"],200);
        return response()->json(null,400);
    }

    public function update(Request $request, $id)
    {
        $results = DB::select('select * from mascotas where id = :id', ['id' => $id]);
       

        if($results==[])
        {
            return response()->json(["No existe el Id de la Mascota"]);
        }
        else
        {
            
            if($request->nombre == "")
            {
                return response()->json(['messeage' => 'Favor de insertar Nombre'],400); 
            }
            elseif($request->raza == "")
            {
                return response()->json(['messeage' => 'Favor de insertar el nombre de la Raza'],400); 
            }
            elseif($request->tipo == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el tipo de animal'],400); 
        }
            elseif($request->edad == "")
            {
                return response()->json(['messeage' => 'Favor de insertar la edad correspondiente'],400); 
            }
            elseif($request->cliente == "")
            {
                return response()->json(['messeage' => 'Favor de insertar el Id del cliente'],400); 
            }

            
        $update = new MascotasModel();
        $update = MascotasModel::find($id);
        $update->nombre = $request->get('nombre');
        $update->raza = $request->get('raza');
        $update->tipo = $request->get('tipo');
        $update->edad = $request->get('edad');
        $update->cliente = $request->get('cliente');
        if($update->save())
        return response()->json(["Se ha actualizado el cliente exitosamente"],200);
        }
    }

    public function destroy($id)
    {
        MascotasModel::destroy($id);
       return response()->json(["Se ha eliminado la mascota exitosamente"],200);
    }
}
