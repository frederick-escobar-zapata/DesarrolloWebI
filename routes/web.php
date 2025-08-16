<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RutaController;
use App\Http\Controllers\AutenticacionController;

Route::get('/', function () {
    return view('welcome');
});

// 1 mostrar todos los proyectos - listo
Route::get('/MostrarProyectos', [RutaController::class, 'ctrlerMostrarProyectos']);

// 2 Agregar un Proyecto -listo
Route::get('/AgregarProyecto/{id}/{nombre}/{fecha_inicio}/{estado}/{responsable}/{monto}', [App\Http\Controllers\RutaController::class, 'ctrlerAgregarProyecto']);

// 3 Eliminar proyecto por su Id -listo
Route::get('EliminarProyectoId/{id}', [App\Http\Controllers\RutaController::class, 'ctrlerEliminarProyectoId']);

// 4 Actualizar proyecto por su id -listo
Route::get('/ActualizarProyectoId/{id}/{nombre}/{fecha_inicio}/{estado}/{responsable}/{monto}', [App\Http\Controllers\RutaController::class, 'ctrlerActualizarProyecto']);

// 5. mostrar proyecto por su Id -listo
Route::get('/MostrarProyectosId/{id}', [App\Http\Controllers\RutaController::class, 'ctrlerMostrarProyectoId']);

Route::get('/login', [AutenticacionController::class, 'FormularioLogin']);
Route::get('/registro', [AutenticacionController::class, 'FormularioRegistro']);

