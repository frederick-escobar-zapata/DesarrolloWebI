@extends('layouts.app')

@section('title', 'Proyecto Actualizado')

@section('header', 'Proyecto Actualizado')
@section('subtitle', 'Comparación antes y después de la actualización')

@section('content')
<div class="card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0">
            <i class="bi bi-check-circle"></i> Actualización Exitosa
            @if(isset($proyectoDespues) && $proyectoDespues)
                <span class="badge bg-light text-dark">ID: {{ $proyectoDespues->id }}</span>
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

        @if(isset($proyectoAntes) && $proyectoAntes && isset($proyectoDespues) && $proyectoDespues)
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i> 
                <strong>¡Actualización completada!</strong> El proyecto ha sido modificado exitosamente.
            </div>
            
            <!-- Proyecto ANTES -->
            <div class="card border-warning mb-4">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="bi bi-clock-history"></i> Antes de la Actualización
                    </h6>
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
                            <tr class="table-warning">
                                <td>
                                    <span class="badge bg-secondary">{{ $proyectoAntes->id ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <strong>{{ $proyectoAntes->nombre ?? 'Sin nombre' }}</strong>
                                </td>
                                <td>
                                    @if($proyectoAntes->fecha_inicio)
                                        {{ date('d/m/Y', strtotime($proyectoAntes->fecha_inicio)) }}
                                    @else
                                        <span class="text-muted">Sin fecha</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($proyectoAntes->estado)
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
                                            <span class="badge bg-secondary">{{ $proyectoAntes->estado ?? 'Sin estado' }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <i class="bi bi-person"></i> {{ $proyectoAntes->responsable ?? 'Sin asignar' }}
                                </td>
                                <td>
                                    <strong>
                                        ${{ number_format($proyectoAntes->monto ?? 0, 0, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>           
            </div>

            <!-- Proyecto DESPUÉS -->
            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    <h6 class="mb-0">
                        <i class="bi bi-check-circle"></i> Después de la Actualización
                    </h6>
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
                                    <span class="badge bg-secondary">{{ $proyectoDespues->id ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <strong>{{ $proyectoDespues->nombre ?? 'Sin nombre' }}</strong>
                                </td>
                                <td>
                                    @if($proyectoDespues->fecha_inicio)
                                        {{ date('d/m/Y', strtotime($proyectoDespues->fecha_inicio)) }}
                                    @else
                                        <span class="text-muted">Sin fecha</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($proyectoDespues->estado)
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
                                            <span class="badge bg-secondary">{{ $proyectoDespues->estado ?? 'Sin estado' }}</span>
                                    @endswitch
                                </td>
                                <td>
                                    <i class="bi bi-person"></i> {{ $proyectoDespues->responsable ?? 'Sin asignar' }}
                                </td>
                                <td>
                                    <strong>
                                        ${{ number_format($proyectoDespues->monto ?? 0, 0, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            
            
           <div class="mt-4 text-center">
                <a href="/MostrarProyectos" class="btn btn-primary">
                    <i class="bi bi-list"></i> Ver Todos los Proyectos
                </a>                
            </div> 
            
        @else
            <div class="text-center py-5">
                <i class="bi bi-exclamation-circle display-1 text-muted"></i>
                <h3 class="text-muted mt-3">No se pudo actualizar el proyecto</h3>
                <p class="text-muted">Ocurrió un error durante la actualización</p>
                <a href="/MostrarProyectos" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
 
                    
