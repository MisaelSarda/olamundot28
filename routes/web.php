<?php

// rotas - controllers
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\contatoController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\imcController;
use App\Http\Controllers\SaudeController;
use App\Http\Controllers\ConsumoCombustivelController;

Route::get('/', function () {
    return view('home');
});

Route::resource('contato', contatoController::class);
Route::get('/sobre', [SobreController::class, 'sobre']);

// Exercicio I - Calculo IMC 


Route::get('/imc', [imcController::class, 'exercicio']);
Route::post('/imc', [imcController::class, 'calcularIMC']);

//Exercicio II

Route::get('/saude', [saudecontroller::class, 'index']);
Route::post('/saude', [saudecontroller::class, 'calcularSaude']);

//ExercicioIII
Route::get('/consumo-combustivel', [ConsumoCombustivelController::class, 'index']);
Route::post('/consumo-combustivel', [ConsumoCombustivelController::class, 'calcularConsumo']);
