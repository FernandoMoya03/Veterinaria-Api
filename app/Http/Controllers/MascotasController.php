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
         /*   Si se un ID se busca por ahi siempre y cuando el status sea 1  */
        if($id)
        {
            return response()->json(["Mascota"=>
            $results = DB::select('select * from mascotas where status = 1
            and id = :id', ['id' => $id])
            ],200);
        }
        /*   Si no se tiene un ID se busca en general siempre y cuando el status sea 1  */
        return response()->json(["Mascotas"=>
            $results = DB::select('select * from mascotas where status = 1')
            ],200); 
       
    }

   
    public function create(Request $request)
    {
        /*   Validaciones de campos vacios  */
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
        /*   Instancia de la Tabla por acceso del Modelo   */
        $user = new MascotasModel();
        $user->nombre = $request->nombre;
        $user->raza = $request->raza;
        $user->tipo = $request->tipo;
        $user->edad = $request->edad;
        $user->cliente = $request->cliente;
        /*   Status hardcodeado a 1   */
        $user->status = 1;

        if($user->save())
        return response()->json(["Se ha agregado la mascota con exito!!!"],200);
        return response()->json(null,400);
    }

    public function update(Request $request, $id)
    {
        /*   Consulta para verificar si existe la mascota  */
        $results = DB::select('select * from mascotas where id = :id', ['id' => $id]);
       
        /*   Validaciones de campos vacios  */
        if($results==[])
        {
            return response()->json(["No existe el Id de la Mascota"]);
        }
        else
        {
            /*   Validaciones de campos vacios  */
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
        /*   Se elimina completamente el campo con el ID asignado  */
        MascotasModel::destroy($id);
       return response()->json(["Se ha eliminado la mascota exitosamente"],200);
    }

    public function changeStatus($id)
    {
        /*   Se cambia el status a 1 */
        $update = new MascotasModel();
        $update = MascotasModel::find($id);
        $update->status = 0;
        $update->save();
        return response()->json(["CORRECTO"],200);
        
    }
}
