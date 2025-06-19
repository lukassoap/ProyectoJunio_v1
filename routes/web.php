<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TramiteController;

// Ruta principal
Route::get('/', function () {
    return view('welcome');
});

// Autenticación de usuarios
Route::get('login', [UsuarioController::class, 'showLoginForm'])->name('usuario.login');
Route::post('login', [UsuarioController::class, 'login']);
Route::post('logout', [UsuarioController::class, 'logout'])->name('usuario.logout');

Route::get('register', [UsuarioController::class, 'showRegisterForm'])->name('usuario.register');
Route::post('register', [UsuarioController::class, 'register']);

// Rutas de trámites (requieren estar autenticado)
Route::middleware('auth')->group(function () {
    Route::get('usuario/editar', [UsuarioController::class, 'edit'])->name('usuario.edit');
    Route::post('usuario/editar', [UsuarioController::class, 'update'])->name('usuario.update');
    Route::get('tramites', [TramiteController::class, 'index'])->name('tramite.index');
    Route::get('tramites/create', [TramiteController::class, 'create'])->name('tramite.create');
    Route::get('tramites/pagar', [TramiteController::class, 'pagar'])->name('tramite.pagar');
    Route::get('tramites/metodo-pago', [TramiteController::class, 'metodoPagoForm'])->name('tramite.metodo_pago_form');
    Route::post('tramites/metodo-pago', [TramiteController::class, 'procesarMetodoPago'])->name('tramite.procesar_metodo_pago');
    Route::post('tramites', [TramiteController::class, 'store'])->name('tramite.store');
    Route::get('tramites/{id}', [TramiteController::class, 'show'])->name('tramite.show');
    Route::delete('tramites/{id}', [TramiteController::class, 'destroy'])->name('tramite.destroy');
});
