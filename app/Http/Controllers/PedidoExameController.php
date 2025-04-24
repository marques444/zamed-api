<?php

namespace App\Http\Controllers;

use App\Models\PedidoExame;
use Illuminate\Http\Request;

class PedidoExameController extends Controller
{
    public function index() {
        return PedidoExame::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'descricao' => 'required|string',
        ]);

        $pedido = PedidoExame::create($data);

        return response()->json([
            'mensagem' => 'Pedido de exame criado com sucesso',
            'pedido_exame' => $pedido
        ], 201);
    }

    public function show($id) {
        return PedidoExame::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $pedido = PedidoExame::findOrFail($id);
        $pedido->update($request->all());
        return $pedido;
    }

    public function destroy($id) {
        return PedidoExame::destroy($id);
    }
}
