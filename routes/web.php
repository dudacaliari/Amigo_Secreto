<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\GiftController;

Route::get('/', [PessoaController::class, 'index'])->name('home');

// Rotas para Pessoa
Route::get('/pessoa/create', [PessoaController::class, 'create'])->name('pessoa.create');
Route::post('/pessoa', [PessoaController::class, 'store'])->name('pessoa.store');
Route::get('/pessoa/{id}/edit', [PessoaController::class, 'edit'])->name('pessoa.edit');
Route::put('/pessoa/{id}', [PessoaController::class, 'update'])->name('pessoa.update');
Route::delete('/pessoa/{id}', [PessoaController::class, 'destroy'])->name('pessoa.destroy');
Route::get('/sorteio', [PessoaController::class, 'sorteio'])->name('sorteio');
Route::get('/pessoa/{id}/confirmar-delecao', [PessoaController::class, 'confirmarDelecao'])->name('pessoa.confirmarDelecao');

// Rotas para Gift
Route::get('/gift/create', [GiftController::class, 'create'])->name('gift.create');
Route::post('/gift', [GiftController::class, 'store'])->name('gift.store');
Route::get('/gift/{id}/edit', [GiftController::class, 'edit'])->name('gift.edit');
Route::put('/gift/{id}', [GiftController::class, 'update'])->name('gift.update');
Route::delete('/gift/{id}', [GiftController::class, 'destroy'])->name('gift.destroy');
Route::post('/gifts', [PessoaController::class, 'addGift'])->name('gifts.add');

Route::post('/gifts', [PessoaController::class, 'addGift'])->name('gifts.add');