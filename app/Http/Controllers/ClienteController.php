<?php

namespace App\Http\Controllers;
use App\ClienteModel;
use App\Models\cliente;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index($id = null)
    {
        if($id)
        return response()->json(["Cliente"=>ClienteModel::find($id)],200);
        return response()->json(["Clientes"=>ClienteModel::all()],200);
    }
    
    public function create(Request $request)
    {
        if($request->nombre == "")
        {
            return response()->json(['messeage' => 'Favor de insertar Nombre'],400); 
        }
        elseif($request->direccion == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la direccion'],400); 
        }
        elseif($request->telefono == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el Numero de Telefono'],400); 
        }

        $user = new ClienteModel();
        $user->nombre = $request->nombre;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;

        if($user->save())
        return response()->json(["Se ha agregado el cliente con exito!!!"],200);
        return response()->json(null,400);
    }

    public function update(Request $request, $id)
    {
        $results = DB::select('select * from cliente where id = :id', ['id' => $id]);
       

        if($results==[])
        {
            return response()->json(["No existe el Id del Cliente"]);
        }
        else
        {

            if($request->nombre == "")
            {
                return response()->json(['messeage' => 'Favor de insertar Nombre'],400); 
            }
            elseif($request->direccion == "")
            {
                return response()->json(['messeage' => 'Favor de insertar la direccion'],400); 
            }
            elseif($request->telefono == "")
            {
                return response()->json(['messeage' => 'Favor de insertar el Numero de Telefono'],400); 
            }

        $update = new ClienteModel();
        $update = ClienteModel::find($id);
        $update->nombre = $request->get('nombre');
        $update->direccion = $request->get('direccion');
        $update->telefono = $request->get('telefono');
        if($update->save())
        return response()->json(["Se ha actualizado el cliente exitosamente"],200);
        }
    }

   
    public function destroy($id)
    {
        ClienteModel::destroy($id);
       return response()->json(["Se ha eliminado el cliente exitosamente"],200);
    }
}
