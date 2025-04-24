<?php

namespace App\Http\Controllers;

use App\Models\Laboratorio;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    public function index() {
        return Laboratorio::all();
    }

    public function store(Request $request) {
        return Laboratorio::create($request->all());
    }

    public function show($id) {
        return Laboratorio::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $laboratorio = Laboratorio::findOrFail($id);
        $laboratorio->update($request->all());
        return $laboratorio;
    }

    public function destroy($id) {
        return Laboratorio::destroy($id);
    }

    // LOGIN DO LABORATÓRIO
    public function login(Request $request) {
        $laboratorio = Laboratorio::where('nome', $request->nome)
                                  ->where('senha', $request->senha)
                                  ->first();

        if (!$laboratorio) {
            return response()->json(['erro' => 'Credenciais inválidas'], 401);
        }

        return response()->json(['mensagem' => 'Login realizado com sucesso', 'laboratorio' => $laboratorio]);
    }

    // ENVIO DE RESULTADOS DE EXAMES
    public function enviarResultados(Request $request, $id) {
        $data = $request->validate([
            'pedido_exame_id' => 'required|integer',
            'resultado' => 'required|string',
        ]);

        // Aqui você pode salvar esse resultado em uma tabela própria ou atualizar um exame existente.
        return response()->json([
            'mensagem' => 'Resultado enviado com sucesso para o pedido' . $data['pedido_exame_id'],
            'laboratorio_id' => $id,
            'resultado' => $data['resultado']
        ]);
    }
}
