<?php

namespace App\Http\Controllers;

use App\Models\Medico;
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
}
