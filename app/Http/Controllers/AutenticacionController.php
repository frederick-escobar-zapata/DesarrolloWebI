<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;



class AutenticacionController extends Controller
{

    public function FormularioRegistro(Request $request)
    {
        return view('registro');
    }
    public function Registro(Request $request)
    {   

        // aca validamos los datos de entrada
        $validador = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'rol' => 'required|string|max:50|in:admin,usuario',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            // generamos los mensajes de error personalizados
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe exceder 255 caracteres.',
            'apellido.required' => 'El apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser una cadena de texto.',
            'apellido.max' => 'El apellido no debe exceder 255 caracteres.',
            'rol.required' => 'El rol es obligatorio.',
            'rol.string' => 'El rol debe ser una cadena de texto.',
            'rol.max' => 'El rol no debe exceder 50 caracteres.',
            'rol.in' => 'El rol debe ser admin o usuario.',
            'email.required' => 'El correo es obligatorio.',
            'email.string' => 'El correo debe ser una cadena de texto.',
            'email.email' => 'El correo debe ser un correo válido.',
            'email.max' => 'El correo no debe exceder 255 caracteres.',
            'email.unique' => 'El correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser una cadena de texto.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);


        // aca validamos si el validardor falla retornando un json con los errores
        if ($validador->fails()) {
            return response()->json(['error' => $validador->errors()], 422);
        }

        // aca creamos el usuario en la base de datos 
        User::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'rol' => $request->rol,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // aca retornamos un mensaje de exito cuando es registrado correctamente
        return response()->json(['message' => 'Usuario registrado con éxito'], 201);
    }

    public function FormularioLogin(Request $request)
    {
        return view('login');
    }

    public function Login(Request $request)
    {
        // aca validamos los datos de entrada pero del login
        $validador = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // aca validamos si el validardor falla retornando un json con los errores
        if ($validador->fails()) {
            return response()->json(['error' => $validador->errors()], 422);
        }
        // aca obtenemos las credenciales del usuario
        $credenciales = $request->only('email', 'password');
        // aca intentamos crear un token JWT
        try {
            if (!$token =  JWTAuth::attempt($credenciales)) {
                return response()->json(['error' => 'Credenciales inválidas'], 401);
            }
            return response()->json(['token' => $token], 200);

            // aca si falla la creacion del token, retornamos un mensaje de error
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo crear el token'], 500);
        }
    }

    public function getUser(Request $request)
    {

        // aca obtenemos el usuario autenticado a partir del token JWT
        try {
            $user = JWTAuth::user();
            return response()->json(['user' => $user], 200);

            // aca si falla la obtencion del usuario, retornamos un mensaje de error
        } catch (JWTException $e) {
            return response()->json(['error' => 'No se pudo obtener el usuario'], 500);
        }
    }

    public function Logout(Request $request)
    {   

        // aca invalidamos el token JWT
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Usuario desconectado con éxito'], 200);
    }
}
