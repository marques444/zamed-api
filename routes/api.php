<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\PedidoExameController;
use App\Http\Controllers\ResultadoExameController;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ExameController;
use App\Http\Controllers\LaboratorioController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PacienteController;

// RECEITAS
Route::post('/receitas', [ReceitaController::class, 'store']);

// PEDIDOS DE EXAMES
Route::post('/pedidos-exames', [PedidoExameController::class, 'store']);

// RESULTADOS DE EXAMES
Route::post('/resultados-exames', [ResultadoExameController::class, 'store']);

// PACIENTES
Route::post('/pacientes', [PacienteController::class, 'store']);
Route::post('/pacientes/login', [PacienteController::class, 'login']);
Route::get('/pacientes/{id}/receitas', [PacienteController::class, 'visualizarReceitas']);
Route::post('/pacientes/{id}/consultas', [PacienteController::class, 'agendarConsulta']);

// MÉDICOS
Route::post('/medicos', [MedicoController::class, 'store']);
Route::post('/medicos/login', [MedicoController::class, 'login']);
Route::post('/medicos/{id}/receitas', [MedicoController::class, 'emitirReceita']);
Route::post('/medicos/{id}/exames', [MedicoController::class, 'solicitarExame']);

// CONSULTAS
Route::post('/consultas', [ConsultaController::class, 'store']);
Route::put('/consultas/{id}/cancelar', [ConsultaController::class, 'cancelar']);

// EXAMES
Route::post('/exames/{id}/realizar', [ExameController::class, 'realizarExame']);
Route::post('/exames/{id}/resultado', [ExameController::class, 'enviarResultado']);

// LABORATÓRIOS
Route::post('/laboratorios', [LaboratorioController::class, 'store']);
Route::post('/laboratorios/login', [LaboratorioController::class, 'login']);
Route::post('/laboratorios/{id}/resultados', [LaboratorioController::class, 'enviarResultados']);

// ADMINISTRADOR
Route::post('/admin/usuarios', [AdministradorController::class, 'gerenciarUsuarios']);
Route::post('/admin/medicos', [AdministradorController::class, 'cadastrarMedico']);
Route::post('/admin/laboratorios', [AdministradorController::class, 'cadastrarLaboratorio']);
