<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceitaController extends Controller
{
    public function index() {
        return Receita::all();
    }

    public function store(Request $request) {
        $data = $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'texto' => 'required|string',
        ]);

        // Gera o PDF com a lib dompdf
        $pdf = PDF::loadView('pdf.receita', ['texto' => $data['texto']]);

        // Nome do arquivo
        $filePath = 'receitas/' . uniqid() . '.pdf';
        Storage::disk('public')->put($filePath, $pdf->output());

        // Salva a receita no banco
        $receita = Receita::create([
            'paciente_id' => $data['paciente_id'],
            'medico_id' => $data['medico_id'],
            'arquivo' => $filePath,
            'texto' => $data['texto']
        ]);

        return response()->json([
            'mensagem' => 'Receita gerada com sucesso',
            'receita' => $receita,
            'link_pdf' => Storage::url($filePath)
        ], 201);
    }

    public function show($id) {
        return Receita::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $receita = Receita::findOrFail($id);
        $receita->update($request->all());
        return $receita;
    }

    public function destroy($id) {
        return Receita::destroy($id);
    }
}
