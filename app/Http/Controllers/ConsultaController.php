<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index() {
        return Consulta::all();
    }

    //CRIA CONSULTA
    public function store(Request $request) {
        return Consulta::create($request->all());
    }

    public function show($id) {
        return Consulta::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $consulta = Consulta::findOrFail($id);
        $consulta->update($request->all());
        return $consulta;
    }

    public function destroy($id) {
        return Consulta::destroy($id);
    }

     //  CANCELA CONSULTA
     public function cancelar($id) {
        $consulta = Consulta::findOrFail($id);
        $consulta->status = 'cancelada';
        $consulta->save();

        return response()->json([
            'mensagem' => 'Consulta cancelada com sucesso',
            'consulta' => $consulta
        ]);
    }
}
