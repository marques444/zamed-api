<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
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
}
