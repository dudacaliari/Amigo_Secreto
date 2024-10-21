<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;

Route::get('/', [PessoaController::class, 'index'])->name('home');
Route::get('/pessoa/create', [PessoaController::class, 'create'])->name('pessoa.create');
Route::post('/pessoa', [PessoaController::class, 'store'])->name('pessoa.store');
Route::get('/pessoa/{id}/edit', [PessoaController::class, 'edit'])->name('pessoa.edit');
Route::put('/pessoa/{id}', [PessoaController::class, 'update'])->name('pessoa.update');
Route::delete('/pessoa/{id}', [PessoaController::class, 'destroy'])->name('pessoa.destroy');
Route::get('/sorteio', [PessoaController::class, 'sorteio'])->name('sorteio');
Route::get('/pessoa/{id}/confirmar-delecao', [PessoaController::class, 'confirmarDelecao'])->name('pessoa.confirmarDelecao');


