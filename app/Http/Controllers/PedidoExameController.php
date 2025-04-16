<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PedidoExameController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'detalhes' => 'required|string',
        ]);
    
        $pedido = PedidoExame::create([
            'medico_id' => $request->medico_id,
            'paciente_id' => $request->paciente_id,
            'detalhes' => $request->detalhes,
        ]);
    
        // aqui você chama seu sistema pra enviar ao laboratório
    
        return response()->json($pedido);
    }
}
