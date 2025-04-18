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
}
