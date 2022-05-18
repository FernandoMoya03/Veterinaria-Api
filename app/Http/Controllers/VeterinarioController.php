<?php

namespace App\Http\Controllers;

use App\ClienteModel;
use App\MascotasModel;
use App\VeterinarioModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
   
    public function index($id = null)
    {
        if($id)
        return response()->json(["Veterinario"=>VeterinarioModel::find($id)],200);
        return response()->json(["Veterinarios"=>VeterinarioModel::all()],200);
    }

  
    public function create(Request $request)
    {
        
        if($request->nombre == "")
        {
            return response()->json(['messeage' => 'Favor de insertar Nombre'],400); 
        }
        elseif($request->direccion == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la Direccion'],400); 
        }
        elseif($request->telefono == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el Numero de Telefono'],400); 
        }
        elseif($request->rol == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el Id del Rol'],400); 
        }

        $user = new VeterinarioModel();
        $user->nombre = $request->nombre;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->rol = $request->rol;

        if($user->save())
        return response()->json(["Se ha agregado el cliente con exito!!!"],200);
        return response()->json(null,400);
    }

  
    public function update(Request $request, $id)
    {
        $results = DB::select('select * from personal where id = :id', ['id' => $id]);   
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
            elseif($request->direccion == "")
            {
                return response()->json(['messeage' => 'Favor de insertar la Direccion'],400); 
            }
            elseif($request->telefono == "")
            {
                return response()->json(['messeage' => 'Favor de insertar el Numero de Telefono'],400); 
            }
            elseif($request->rol == "")
            {
                return response()->json(['messeage' => 'Favor de insertar el Id del Rol'],400); 
            }    
        

        $update = new VeterinarioModel();
        $update = VeterinarioModel::find($id);
        $update->nombre = $request->get('nombre');
        $update->direccion = $request->get('direccion');
        $update->telefono = $request->get('telefono');
        $update->rol = $request->get('rol');
        if($update->save())
        return response()->json(["Se ha actualizado el cliente exitosamente"],200);
        }
    }

  
    public function destroy($id)
    {
        VeterinarioModel::destroy($id);
        return response()->json(["Se ha eliminado el veterinario exitosamente"],200);
    }
}
