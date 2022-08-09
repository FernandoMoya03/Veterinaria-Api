<?php

namespace App\Http\Controllers;
use App\ClienteModel;
use App\Models\cliente;
use App\VeterinarioModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ClienteController extends Controller
{
    public function index($id = null)
    {

        /*   Si se un ID se busca por ahi siempre y cuando el status sea 1  */
       if($id)
        {
            return response()->json(["Cliente"=>
            $results = DB::select('select id, nombre, direccion, telefono from clientes where status = 1
            and id = :id', ['id' => $id])
            ],200);
        }
        /*   Si no se tiene un ID se busca en general siempre y cuando el status sea 1  */
        return response()->json(["Clientes"=>
            $results = DB::select('select id, nombre, direccion, telefono from clientes where status = 1')
            ],200);

       /* if($id)
        return response()->json(["Cliente"=>ClienteModel::find($id)],200);
        return response()->json(["Clientes"=>ClienteModel::all()],200); */
    }

    public function nombreClienteMascota(Request $request){ 
        /*  Consulta SQL para tabla FRONT END  */
        $mascotas = DB::table('mascotas')
        ->join('clientes', 'clientes.id', '=' , 'mascotas.cliente')
        ->where('clientes.id','=', $request->cliente_id)
        ->select('mascotas.id as id_mascota','mascotas.nombre as mascota')
        ->get();
        return response()->json($mascotas); 
    }

    public function clienteMascota(Request $request){ 
        /*  Consulta SQL para tabla FRONT END  */
        $mascotas = DB::table('mascotas')
        ->join('clientes', 'clientes.id', '=' , 'mascotas.cliente')
        ->select('mascotas.id as m_id','mascotas.nombre as m_nombre','mascotas.raza as m_raza','mascotas.tipo as m_tipo','mascotas.edad as m_edad', 'clientes.nombre as c_nombre')
        ->where('mascotas.status', '=', '1')
        ->get();
        return response()->json($mascotas); 
    }
    
    public function create(Request $request)
    {
        /*   Validaciones de campos vacios  */
        if(!$request->nombre)
        {
            return response()->json(['messeage' => 'Favor de insertar Nombre'],400); 
        }
        elseif(!$request->direccion)
        {
            return response()->json(['messeage' => 'Favor de insertar la direccion'],400); 
        }
        elseif(!$request->telefono)
        {
            return response()->json(['messeage' => 'Favor de insertar el Numero de Telefono'],400); 
        }
        /*   Instancia de la Tabla por acceso del Modelo   */
        $user = new ClienteModel();
        $user->nombre = $request->nombre;
        $user->direccion = $request->direccion;
        $user->telefono = $request->telefono;
        /*   Status hardcodeado a 1   */
        $user->status = 1;

        if($user->save())
        return response()->json(["Se ha agregado el cliente con exito!!!"],200);
        return response()->json(null,400);
    }

    public function update(Request $request)
    {
        /*   Se toma el ID en el Request  */
        $results = $request->id;

        if($results==[])
        {
            return response()->json(["No existe el Id del Cliente"]);
        }
        else
        {
            /*   Validaciones de campos vacios  */
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
        $update = ClienteModel::find($results);
        $update->nombre = $request->get('nombre');
        $update->direccion = $request->get('direccion');
        $update->telefono = $request->get('telefono');
        if($update->save())
        return response()->json(["Se ha actualizado el cliente exitosamente"],200);
        }

    }

   
    public function destroy($id)
    {
        /*   Se elimina completamente el campo con el ID asignado  */
        ClienteModel::destroy($id);
        return response()->json(["Se ha eliminado el cliente exitosamente"],200);
    }



    public function changeStatus($id)
    {
        /*   Se cambia el status a 1 */
        $update = new ClienteModel();
        $update = ClienteModel::find($id);
        $update->status = 0;
        $update->save();
        return response()->json(["CORRECTO"],200);
        
    }
        
 
}

