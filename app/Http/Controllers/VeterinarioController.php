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


        $results = DB::select('select * from users where id = :id', ['id' => $id]);   
        if($results==[])
        {
            return response()->json(["No existe el Id de la Mascota"]);
        }
        else
        {
           
        $update = VeterinarioModel::find($id);
        $update->name = $request->get('name');
        $update->email = $request->get('email');
        $update->password = Hash::make($request->password);
        $update->direccion = $request->get('direccion');
        $update->telefono = $request->get('telefono'); 
        $update->tipo = $request->get('tipo');
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
