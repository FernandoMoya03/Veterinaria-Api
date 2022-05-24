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
    public function logIn(Request $request)
    {
        $user = VeterinarioModel::where('email', $request->email)->first();
        if(! $user || ! Hash::check($request->password, $user->password))
        {
            return response()->json("credenciales incorrectas", 400);
        }
        
        $token = $user ->createToken($request->email,['user:info'])->plainTextToken;
        return response()->json(["token"=>$token],201);

    }


    public function index()
    {
        //
    }

    public function create()
    {
       // 
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
