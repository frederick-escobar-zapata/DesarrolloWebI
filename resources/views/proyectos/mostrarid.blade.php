@extends('layouts.app')
@section('title', 'Detalles del Proyecto')
@section('header', 'Detalles del Proyecto')
@section('subtitle', 'Información completa del proyecto seleccionado')
@section('content')
<div class="card">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">
            <i class="bi bi-eye"></i> Información del Proyecto
            @if(isset($proyecto) && $proyecto)
                <span class="badge bg-light text-dark">ID: {{ $proyecto->id }}</span>
            @endif
        </h5>
    </div>
    
    <div class="card-body">
        @if(isset($error))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i> {{ $error }}
                <div class="mt-3">
                    <a href="/MostrarProyectos" class="btn btn-primary">
                        <i class="bi bi-list"></i> Ver Todos los Proyectos
                    </a>
                    <a href="/" class="btn btn-outline-secondary">
                        <i class="bi bi-house"></i> Ir al Inicio
                    </a>
                </div>
            </div>
        @endif

        @if(isset($proyecto) && $proyecto)
            <div class="alert alert-info">
                <i class="bi bi-info-circle"></i> 
                <strong>Proyecto encontrado</strong> - A continuación se muestran todos los detalles.
            </div>
            
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Fecha Inicio</th>
                            <th>Estado</th>
                            <th>Responsable</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-success">
                            <td>
                                <span class="badge bg-secondary">{{ $proyecto->id ?? 'N/A' }}</span>
                            </td>
                            <td>
                                <strong>{{ $proyecto->nombre ?? 'Sin nombre' }}</strong>
                            </td>
                            <td>
                                @if($proyecto->fecha_inicio)
                                    {{ date('d/m/Y', strtotime($proyecto->fecha_inicio)) }}
                                @else
                                    <span class="text-muted">Sin fecha</span>
                                @endif
                            </td>
                            <td>
                                @switch($proyecto->estado)
                                    @case('activo')
                                        <span class="badge bg-success">Activo</span>
                                        @break
                                    @case('pendiente')
                                        <span class="badge bg-warning">Pendiente</span>
                                        @break
                                    @case('completado')
                                        <span class="badge bg-primary">Completado</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary">{{ $proyecto->estado ?? 'Sin estado' }}</span>
                                @endswitch
                            </td>
                            <td>
                                <i class="bi bi-person"></i> {{ $proyecto->responsable ?? 'Sin asignar' }}
                            </td>
                            <td>
                                <strong>
                                    ${{ number_format($proyecto->monto ?? 0, 0, ',', '.') }}
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>           
                
            
            
           <div class="mt-4 text-center">
                <a href="/MostrarProyectos" class="btn btn-primary">
                    <i class="bi bi-list"></i> Ver Todos los Proyectos
                </a>                
            </div> 
            
        @else
            <div class="text-center py-5">
                <i class="bi bi-search display-1 text-muted"></i>
                <h3 class="text-muted mt-3">Proyecto no encontrado</h3>
                <p class="text-muted">No se pudo encontrar el proyecto solicitado</p>
                <a href="/MostrarProyectos" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
