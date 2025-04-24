<?php

namespace App\Http\Controllers;

use App\Models\Exame;
use Illuminate\Http\Request;

class ExameController extends Controller
{
    public function index() {
        return Exame::all();
    }

    public function store(Request $request) {
        return Exame::create($request->all());
    }

    public function show($id) {
        return Exame::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $exame = Exame::findOrFail($id);
        $exame->update($request->all());
        return $exame;
    }

    public function destroy($id) {
        return Exame::destroy($id);
    }

    // EXAME REALIZADO
    public function realizarExame($id) {
        $exame = Exame::findOrFail($id);
        $exame->status = 'realizado'; // coluna 'status' na migration
        $exame->save();

        return response()->json([
            'mensagem' => 'Exame marcado como realizado',
            'exame' => $exame
        ]);
    }

    // ENVIO DE RESULTADO
    public function enviarResultado(Request $request, $id) {
        $data = $request->validate([
            'resultado' => 'required|string'
        ]);

        $exame = Exame::findOrFail($id);
        $exame->resultado = $data['resultado']; // coluna 'resultado' na migration
        $exame->save();

        return response()->json([
            'mensagem' => 'Resultado enviado com sucesso',
            'exame' => $exame
        ]);
    }
}
