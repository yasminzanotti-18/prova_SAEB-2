<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VeiculoController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\PainelController;

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');
});

Route::get('/painel', [PainelController::class, 'index'])
->name('painel');

Route::resource('clientes', ClienteController::class)
    ->only(['index', 'create', 'store', 'edit', 'update']);

Route::resource('veiculos', VeiculoController::class)
->only(['index', 'create', 'store', 'edit', 'update']);

Route::resource('agendamentos', AgendamentoController::class)
->only(['index', 'create', 'store', 'edit', 'update']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');