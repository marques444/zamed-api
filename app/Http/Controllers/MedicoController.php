<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use App\Models\Receita;
use App\Models\PedidoExame;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    public function index() {
        return Medico::all();
    }

    public function store(Request $request) {
        return Medico::create($request->all());
    }

    public function show($id) {
        return Medico::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $medico = Medico::findOrFail($id);
        $medico->update($request->all());
        return $medico;
    }

    public function destroy($id) {
        return Medico::destroy($id);
    }

    // LOGIN DO MÉDICO
    public function login(Request $request) {
        $medico = Medico::where('crm', $request->crm)
                        ->where('senha', $request->senha)
                        ->first();

        if (!$medico) {
            return response()->json(['erro' => 'Credenciais inválidas'], 401);
        }

        return response()->json(['mensagem' => 'Login realizado com sucesso', 'medico' => $medico]);
    }

    // EMITIR RECEITA
    public function emitirReceita(Request $request, $id) {
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'texto' => 'required|string',
        ]);

        $receita = Receita::create([
            'medico_id' => $id,
            'paciente_id' => $data['paciente_id'],
            'texto' => $data['texto'],
        ]);

        return response()->json(['mensagem' => 'Receita emitida com sucesso', 'receita' => $receita]);
    }

    // SOLICITAR EXAME
    public function solicitarExame(Request $request, $id) {
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'descricao' => 'required|string',
        ]);

        $pedido = PedidoExame::create([
            'medico_id' => $id,
            'paciente_id' => $data['paciente_id'],
            'descricao' => $data['descricao'],
        ]);

        return response()->json(['mensagem' => 'Exame solicitado com sucesso', 'pedido_exame' => $pedido]);
    }
}
