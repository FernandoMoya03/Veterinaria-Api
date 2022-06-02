<?php

namespace App\Http\Controllers;
use App\ClienteModel;
use App\MascotasModel;
use App\ServicioModel;
use App\HistorialClinicoModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class HistorialClinicoController extends Controller
{

    public function index($id = null)
    {
        if($id)
        return response()->json(["Historial Clinico"=>HistorialClinicoModel::find($id)],200);
        return response()->json(["Total de Historiales Clinicos"=>HistorialClinicoModel::all()],200);
    }

   
    public function create(Request $request)
    {
        if($request->diagnostico == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el diagnostico'],400); 
        }
        elseif($request->fecha == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la fecha'],400); 
        }
        elseif($request->cita == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la cita'],400); 
        }

        $servicio = new HistorialClinicoModel();
        $servicio->diagnostico = $request->diagnostico;
        $servicio->fecha = $request->fecha;
        $servicio->cita = $request->cita;

        if($servicio->save())
        return response()->json(["Se ha agregado el Historial Clinico con exito!!!"],200);
        return response()->json(null,400);
    }


   
    public function update(Request $request, $id)
    {
        $results = DB::select('select * from historial_clinico where id = :id', ['id' => $id]);
       

        if($results==[])
        {
            return response()->json(["No existe el id del Historial Clinico"]);
        }
        else
        {
            
            if($request->diagnostico == "")
        {
            return response()->json(['messeage' => 'Favor de insertar el diagnostico'],400); 
        }
        elseif($request->fecha == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la fecha'],400); 
        }
        elseif($request->cita == "")
        {
            return response()->json(['messeage' => 'Favor de insertar la cita'],400); 
        }
           

            
        $update = new HistorialClinicoModel();
        $update = HistorialClinicoModel::find($id);
        $update->diagnostico = $request->get('diagnostico');
        $update->fecha = $request->get('fecha');
        $update->cita = $request->get('cita');
        
        if($update->save())
        return response()->json(["Se ha actualizado el historial clinico exitosamente"],200);
        }
    }

  
    public function destroy($id)
    {
        HistorialClinico::destroy($id);
        return response()->json(["Se ha eliminado el historial clinico exitosamente"],200);
    }
}
