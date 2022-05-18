<?php

namespace App\Http\Controllers;
use App\ClienteModel;
use App\Models\cliente;
use DB;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index($id = null)
    {
        //$results = DB::select('select * from cliente');
        //return response()->json(["clientes"=>$results],200);
        if($id)
        return response()->json(["Cliente"=>ClienteModel::find($id)],200);
        return response()->json(["Clientes"=>ClienteModel::all()],200);
    }
    
    public function create(Request $request)
    {
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
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
