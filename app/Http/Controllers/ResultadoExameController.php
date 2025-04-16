<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultadoExameController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pedido_exame_id' => 'required|exists:pedidos_exames,id',
            'arquivo_pdf' => 'required|file|mimes:pdf',
        ]);

        $nome = 'resultado_' . time() . '.pdf';
        $request->file('arquivo_pdf')->storeAs('public/resultados', $nome);

        $resultado = ResultadoExame::create([
            'pedido_exame_id' => $request->pedido_exame_id,
            'arquivo_pdf' => 'storage/resultados/' . $nome,
        ]);

        return response()->json(['link_pdf' => asset('storage/resultados/' . $nome)]);
    }
}
