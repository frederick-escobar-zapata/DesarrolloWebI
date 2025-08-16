<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutenticacionController;
use App\Http\Middleware\AutenticacionUsuario;

// rutas publicas

Route::post('/login', [AutenticacionController::class, 'Login'])->name('login');
Route::post('/registro', [AutenticacionController::class, 'Registro'])->name('registro');
Route::get('/formulariologin', [AutenticacionController::class, 'FormularioLogin']);
Route::get('/formularioregistro', [AutenticacionController::class, 'FormularioRegistro']);

//rutas privadas
Route::middleware([AutenticacionUsuario::class])->group(function () {
    Route::controller(AutenticacionController::class)->group(function () {
        Route::post('logout', 'logout');
        Route::get('me', 'getUser');
    });
    Route::get('/me', function (Request $request) {
        $user = auth()->user();
        $token = $request->bearerToken();
        return view('me', compact('user', 'token'));
    });
});