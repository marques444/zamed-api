<?php

namespace App\Http\Controllers;

use App\Models\ResultadoExame;
use Illuminate\Http\Request;

class ResultadoExameController extends Controller
{
    public function index() {
        return ResultadoExame::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'pedido_exame_id' => 'required|exists:pedido_exames,id',
            'resultado' => 'required|string',
        ]);

        $resultado = ResultadoExame::create($data);

        return response()->json([
            'mensagem' => 'Resultado salvo com sucesso',
            'resultado' => $resultado
        ], 201);
    }

    public function show($id) {
        return ResultadoExame::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $resultado = ResultadoExame::findOrFail($id);
        $resultado->update($request->all());
        return $resultado;
    }

    public function destroy($id) {
        return ResultadoExame::destroy($id);
    }
}
