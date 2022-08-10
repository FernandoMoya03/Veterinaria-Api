<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClienteModel;
use App\MascotasModel;
use App\VeterinarioModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function getVeterinarios()
    {
            return response()->json(["Usuarios"=>
            $results = DB::select('select id, name, email, direccion, telefono, tipo from users where status = 1
            and tipo = 1')
            ],200);
    }

    public function index($id = null)
    {
        if($id)
        return response()->json(["Servicio"=>ServicioModel::find($id)],200);
        return response()->json(["Servicios"=>ServicioModel::all()],200);
    }
    
    public function getAsistente()
    {
            return response()->json(["Asistentes"=>
            $results = DB::select('select id, name, email, direccion, telefono, tipo from users where status = 1
            and tipo = 2')
            ],200);
    }
    public function getAllUsuarios()
    { 
            return response()->json(["Usuarios"=>
            $results = DB::select('select id, name, email, direccion, telefono, tipo from users where status = 1')
            ],200);
    }
    public function perfil(Request $request)
    { 
        return response()->json(['Perfil'=>$request->user()],200);
    }
    
    
    public function logIn(Request $request)
    {
        $user = VeterinarioModel::where('email', $request->email)->first();
        if(! $user || ! Hash::check($request->password, $user->password))
        {
            return response()->json("credenciales incorrectas");
        }
        
        $token = $user ->createToken($request->email,['user:info'])->plainTextToken;
        return response()->json(["token"=>$token],201);
    }

    public function createuser(Request $request)
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
        

        $user = new VeterinarioModel();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        $user->password = Hash::make($request->password);
        $user->tipo = $request->tipo;
        $user->status = 1;

        if($user->save())
        return response()->json(["Se ha agregado el cliente con exito!!!"],200);
        return response()->json(null,400);
    }
    
    
}
