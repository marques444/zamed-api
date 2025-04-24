<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Receita;
use App\Models\Consulta;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    //FUNÇÕES PADRÃO
    public function index() {
        return Paciente::all();
    }

    public function store(Request $request) {
        return Paciente::create($request->all());
    }

    public function show($id) {
        return Paciente::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->all());
        return $paciente;
    }

    public function destroy($id) {
        return Paciente::destroy($id);
    }

    // LOGIN DE PACIENTE
    public function login(Request $request) {
        $paciente = Paciente::where('email', $request->email)
                            ->where('senha', $request->senha)
                            ->first();

        if ($paciente) {
            return response()->json(['mensagem' => 'Login bem-sucedido', 'paciente' => $paciente]);
        }

        return response()->json(['mensagem' => 'Credenciais inválidas'], 401);
    }

    // VISUALIZAR RECEITAS DO PACIENTE
    public function visualizarReceitas($id) {
        return Receita::where('paciente_id', $id)->get();
    }

    // AGENDAR CONSULTA
    public function agendarConsulta(Request $request, $id) {
        return Consulta::create([
            'paciente_id' => $id,
            'medico_id' => $request->medico_id,
            'data' => $request->data,
            'horario' => $request->horario,
            'motivo' => $request->motivo
        ]);
    }
}

