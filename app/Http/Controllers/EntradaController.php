<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\User;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
       
        $entradas = Entrada::all();

        return view('entrada.index', compact('entradas'));
       
    }

    public function marcar_asistencia(Request $request)
    {
        
        try {
            $entrada = Entrada::find($request->id);
            if ($entrada) {
                $entrada->asistio = true;
                $entrada->usuario_actualizo_id = auth()->user()->id; // Asumiendo que tienes un campo 'asistio'
                $entrada->save();
                return response()->json(['success' => 'Asistencia marcada con éxito.']);
            }
            return response()->json(['error' => 'Entrada no encontrada.'], 404);
        } catch (\Exception $ex) {
            return response()->json(['error' => 'Error al procesar la solicitud. Motivo: '. $ex->getMessage()], 500);
        }
    }

    public function registrar_cobro(Request $request)
    {
        
        try {
            $entrada = Entrada::find($request->id);
            if ($entrada) {
                $entrada->estado_pago = true;
                $entrada->usuario_cobro_id = auth()->user()->id; // Asumiendo que tienes un campo 'asistio'
                $entrada->save();
                return response()->json(['success' => 'Cobro registrado con éxito.']);
            }
            return response()->json(['error' => 'Entrada no encontrada.'], 404);
        } catch (\Exception $ex) {
            return response()->json(['error' => 'Error al procesar la solicitud. Motivo: '. $ex->getMessage()], 500);
        }
    }

    
}
