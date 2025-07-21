@extends('layouts.app')
@section('title', 'Proyecto Eliminado')
@section('header', 'Proyecto Eliminado')
@section('subtitle', 'Confirmación de eliminación del proyecto')
@section('content')
<div class="card">
    <div class="card-header bg-danger text-white">
        <h5 class="mb-0">
            <i class="bi bi-trash"></i> Proyecto Eliminado 
            @if(isset($total))
                <span class="badge bg-light text-dark">Proyectos restantes: {{ $total }}</span>
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
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i> 
                <strong>¡Eliminación exitosa!</strong> El siguiente proyecto ha sido eliminado del sistema.
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
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <a href="/MostrarProyectos" class="btn btn-primary btn-lg me-md-2">
                    <i class="bi bi-list"></i> Ver Todos los Proyectos
                </a>                
            </div>            
        @else
            <div class="text-center py-5">
                <i class="bi bi-exclamation-circle display-1 text-muted"></i>
                <h3 class="text-muted mt-3">No se pudo eliminar el proyecto</h3>
                <p class="text-muted">Ocurrió un error durante la eliminación</p>
                <a href="/MostrarProyectos" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i> Volver a la lista
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
