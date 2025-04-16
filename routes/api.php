<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\PedidoExameController;
use App\Http\Controllers\ResultadoExameController;

Route::post('/receitas', [ReceitaController::class, 'store']);
Route::post('/pedidos-exames', [PedidoExameController::class, 'store']);
Route::post('/resultados-exames', [ResultadoExameController::class, 'store']);


