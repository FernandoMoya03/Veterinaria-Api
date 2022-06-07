<?php

namespace App\Http\Controllers;

use App\ClienteModel;
use App\MascotasModel;
use App\VeterinarioModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class VeterinarioController extends Controller
{
   
    public function index($id = null)
    {
        if($id)
        return response()->json(["Usuario"=>VeterinarioModel::find($id)],200);
        return response()->json(["Usuarios"=>VeterinarioModel::all()],200);
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
           

            if($request->name == "")
        {
            return response()->json(['messeage' => 'Favor de insertar Nombre'],400); 
        }
        elseif($request->email == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el Email'],400); 
        }
        elseif($request->direccion == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la Direccion'],400); 
        }
        elseif($request->telefono == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el Numero de Telefono'],400); 
        }
        elseif($request->password == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la contraseña'],400); 
        }
        elseif($request->tipo == "")
        {
            return response()->json(['messeage' => 'Favor de indicar el tipo'],400); 
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
