<?php

use App\Livewire\Consulta\Consulta;
use App\Livewire\ContasPagar\CreateContasPagar;
use App\Livewire\ContasPagar\EditContasPagar;
use App\Livewire\ContasPagar\ShowContasPagar;
use App\Livewire\ContasReceber\CreateContasReceber;
use App\Livewire\ContasReceber\EditContasReceber;
use App\Livewire\ContasReceber\ShowContasReceber;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::prefix('contasreceber')->group(function () {

        Route::get('/', ShowContasReceber::class)->name('index.contasreceber');

        Route::get('/create', CreateContasReceber::class)->name('create.contasreceber');

        Route::get('/view/{id}', EditContasReceber::class)->name('edit.contasreceber');
    });

    Route::prefix('contaspagar')->group(function () {

        Route::get('/', ShowContasPagar::class)->name('index.contaspagar');

        Route::get('/create', CreateContasPagar::class)->name('create.contaspagar');

        Route::get('/view/{id}', EditContasPagar::class)->name('edit.contaspagar');
    });
});
