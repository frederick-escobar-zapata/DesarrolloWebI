<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutenticacionUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */



    public function handle(Request $request, Closure $next): Response
    {
        if (auth('api')->user()) {     // aca intento obtener un usuario autenticado usando el guard 'api'
            return $next($request);    // si hay un usuario autenticado, continuar con la solicitud
        }else{
            return response()->json(['error' => 'No   autorizado'], 401);  //aca si no hay usuario retornamos un json con error
        }
    }
 }