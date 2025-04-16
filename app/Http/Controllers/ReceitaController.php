<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceitaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'conteudo' => 'required|string',
        ]);
    
        $pdf = Pdf::loadView('pdfs.receita', ['conteudo' => $request->conteudo]);
    
        $nomeArquivo = 'receita_' . time() . '.pdf';
        Storage::disk('public')->put('receitas/' . $nomeArquivo, $pdf->output());
    
        $receita = Receita::create([
            'medico_id' => $request->medico_id,
            'paciente_id' => $request->paciente_id,
            'conteudo' => $request->conteudo,
            'caminho_pdf' => 'storage/receitas/' . $nomeArquivo,
        ]);
    
        return response()->json(['link_pdf' => asset('storage/receitas/' . $nomeArquivo)]);
    }
}
