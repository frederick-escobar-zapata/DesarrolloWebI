@extends('layouts.app')
@section('title', 'Lista de Proyectos')
@section('header', 'Proyectos Registrados')
@section('subtitle', 'Visualización de todos los proyectos almacenados')
@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="bi bi-kanban"></i> Lista de Proyectos 
            <span class="badge bg-primary">{{ $total }} proyectos</span>
        </h5>
    </div>
    
    <div class="card-body">
        @if(isset($error))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i> {{ $error }}
            </div>
        @endif

        @if($total > 0)
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
                        @foreach($proyectos as $proyecto)
                            <tr>
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
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox display-1 text-muted"></i>
                <h3 class="text-muted mt-3">No hay proyectos registrados</h3>
                <p class="text-muted">Comienza agregando tu primer proyecto</p>
                <a href="/" class="btn btn-primary">
                    <i class="bi bi-arrow-left"></i> Volver al inicio
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
