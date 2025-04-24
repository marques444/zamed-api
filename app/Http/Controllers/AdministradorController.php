<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Medico;
use App\Models\Laboratorio;
use App\Models\Paciente;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    //FUNÇÕES PADRÃO
    public function index() {
        return Administrador::all();
    }

    public function store(Request $request) {
        return Administrador::create($request->all());
    }

    public function show($id) {
        return Administrador::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $admin = Administrador::findOrFail($id);
        $admin->update($request->all());
        return $admin;
    }

    public function destroy($id) {
        return Administrador::destroy($id);
    }

    // GERENCIAR USUÁRIOS (PACIENTES)
    public function gerenciarUsuarios(Request $request) {
        $acao = $request->input('acao');

        if ($acao === 'criar') {
            $paciente = Paciente::create($request->only(['nome', 'cpf', 'senha']));
            return response()->json(['mensagem' => 'Paciente criado', 'paciente' => $paciente], 201);
        }

        if ($acao === 'editar') {
            $paciente = Paciente::findOrFail($request->input('id'));
            $paciente->update($request->only(['nome', 'cpf', 'senha']));
            return response()->json(['mensagem' => 'Paciente atualizado', 'paciente' => $paciente]);
        }

        if ($acao === 'excluir') {
            $deleted = Paciente::destroy($request->input('id'));
            return response()->json(['mensagem' => 'Paciente excluído', 'apagado' => $deleted]);
        }

        return response()->json(['erro' => 'Ação inválida'], 400);
    }

    // CADASTRAR MÉDICO
    public function cadastrarMedico(Request $request) {
        $medico = Medico::create($request->only(['nome', 'crm']));
        return response()->json(['mensagem' => 'Médico cadastrado com sucesso', 'medico' => $medico], 201);
    }

    // CADASTRAR LABORATÓRIO
    public function cadastrarLaboratorio(Request $request) {
        $laboratorio = Laboratorio::create($request->only(['nome']));
        return response()->json(['mensagem' => 'Laboratório cadastrado com sucesso', 'laboratorio' => $laboratorio], 201);
    }
}
