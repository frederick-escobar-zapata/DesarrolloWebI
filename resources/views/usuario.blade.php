@extends('layouts.app' )

@section('title','Datos de usuarios')

@section('content')
    <h2>Datos de usuario</h2>
    <p><strong>Nombre :</strong> {{ $usuario->nombre }}</p>
    <p><strong>Email :</strong> {{ $usuario->email }}</p>
    <p><strong>Pass :</strong> {{ $usuario->password }}</p>
    <p><strong>Telefono :</strong> {{ $usuario->telefono }}</p>
@endsection