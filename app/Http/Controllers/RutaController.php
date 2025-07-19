<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;

class RutaController extends Controller
{     
    //-------------   1 .- Agregar proyectos - listo-----------------------
    public function ctrlerAgregarProyecto($id,$nombre,$fecha_inicio,$estado,$responsable,$monto)
    {
        try {
            $proyectos = session('proyectos', []);                     
            $proyecto = new Proyecto();
            $proyecto->id = $id;
            $proyecto->nombre = $nombre;
            $proyecto->fecha_inicio = $fecha_inicio;
            $proyecto->estado = $estado;
            $proyecto->responsable = $responsable;
            $proyecto->monto = $monto;           
            $proyectos[] = $proyecto->toArray();            
            session(['proyectos' => $proyectos]);            
            return response()->json([
                'mensaje' => 'Proyecto agregado exitosamente',
                'proyecto' => $proyecto
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al agregar proyecto',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }


     //-------------   2 .- Mostrar todos los proyectos - listo-----------------------
    public function ctrlerMostrarProyectos()
    {
        try {            
            $proyectosData = session('proyectos',[]);
            $proyectos = collect($proyectosData)->map(function ($data) {
                $proyecto = new Proyecto();
                $proyecto->fill($data);                
                return $proyecto;
            });            
            return response()->json([
                'proyectos' => $proyectos,
                'total' => $proyectos->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener proyectos',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

    
     //-------------   3 .- Eliminar proyectos por ID - listo-----------------------
    public function ctrlerEliminarProyectoId($id){
        try {
            $proyectos = session('proyectos', []);
            $proyectos = collect($proyectos)->filter(function ($proyecto) use ($id) {
                return $proyecto['id'] != $id;
            })->values()->all();            
            session(['proyectos' => $proyectos]);            
            return response()->json([
                'mensaje' => 'Proyecto eliminado exitosamente',
                'total' => count($proyectos)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al eliminar proyecto',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }


     //-------------   4 .- Actulizar proyectos por ID - isto----------------------- //
     public function ctrlerActualizarProyecto($id, $nombre, $fecha_inicio, $estado, $responsable, $monto){
        try {
            $proyectos = session('proyectos', []);
            $proyecto = collect($proyectos)->firstWhere('id', $id);
            
            if (!$proyecto) {
                return response()->json(['error' => 'Proyecto no encontrado'], 404);
            }

            $proyecto['nombre'] = $nombre;
            $proyecto['fecha_inicio'] = $fecha_inicio;
            $proyecto['estado'] = $estado;
            $proyecto['responsable'] = $responsable;
            $proyecto['monto'] = $monto;

            session(['proyectos' => collect($proyectos)->map(function ($p) use ($proyecto) {
                return $p['id'] == $proyecto['id'] ? $proyecto : $p;
            })->values()->all()]);

            return response()->json(['mensaje' => 'Proyecto actualizado exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar proyecto', 'mensaje' => $e->getMessage()], 500);
        }
        
    }

     //-------------   5 .- Mostrar los proyectos por ID - listo-----------------------
    public function ctrlerMostrarProyectoId($id)
    {
        try {
            $proyectos = session('proyectos', []);
            $proyecto = collect($proyectos)->firstWhere('id', $id);
            
            if (!$proyecto) {
                return response()->json([
                    'error' => 'Proyecto no encontrado'
                ], 404);
            }                    
            $proyectos = new Proyecto();
            $proyectos->fill($proyecto);
            $proyectos->id = $proyecto['id'];
            
            return response()->json([
                'mensaje' => 'Proyecto encontrado exitosamente',
                'proyecto' => $proyectos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al mostrar proyecto',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

    
}

