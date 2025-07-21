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
            return view('proyectos.agregar', [
                'proyecto' => $proyecto,
                'total' => count($proyectos)
            ]);
        } catch (\Exception $e) {
            return view('proyectos.agregar', [
                'proyecto' => null,
                'total' => 0,
                'error' => 'Error al agregar proyecto: ' . $e->getMessage()
            ]);
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
                $proyecto->id = $data['id'];
                return $proyecto;
            });                      
            return view('proyectos.mostrar', [
                'proyectos' => $proyectos,
                'total' => $proyectos->count()
            ]);
        } catch (\Exception $e) {
            return view('proyectos.mostrar', [
                'proyectos' => collect([]),
                'total' => 0,
                'error' => 'Error al obtener proyectos: ' . $e->getMessage()
            ]);
        }
    }

    
     //-------------   3 .- Eliminar proyectos por ID - listo-----------------------
    public function ctrlerEliminarProyectoId($id){
        try {
            $proyectos = session('proyectos', []);
            $proyectoEliminado = collect($proyectos)->firstWhere('id', $id);
            
            if (!$proyectoEliminado) {
                return view('proyectos.eliminarid', [
                    'proyecto' => null,
                    'error' => 'Proyecto no encontrado'
                ]);
            }
            
            // Crear instancia del modelo del proyecto eliminado
            $proyecto = new Proyecto();
            $proyecto->fill($proyectoEliminado);
            $proyecto->id = $proyectoEliminado['id'];
            
            // Eliminar el proyecto del array
            $proyectos = collect($proyectos)->filter(function ($p) use ($id) {
                return $p['id'] != $id;
            })->values()->all();            
            session(['proyectos' => $proyectos]);
            
            return view('proyectos.eliminarid', [
                'proyecto' => $proyecto,
                'total' => count($proyectos)
            ]);
        } catch (\Exception $e) {
            return view('proyectos.eliminarid', [
                'proyecto' => null,
                'error' => 'Error al eliminar proyecto: ' . $e->getMessage()
            ]);
        }
    }


     //-------------   4 .- Actulizar proyectos por ID - isto----------------------- //
     public function ctrlerActualizarProyecto($id, $nombre, $fecha_inicio, $estado, $responsable, $monto){
        try {
            $proyectos = session('proyectos', []);
            $proyectoOriginal = collect($proyectos)->firstWhere('id', $id);
            
            if (!$proyectoOriginal) {
                return view('proyectos.actualizarid', [
                    'proyectoAntes' => null,
                    'proyectoDespues' => null,
                    'error' => 'Proyecto no encontrado'
                ]);
            }

            // Crear instancia del proyecto antes de actualizar
            $proyectoAntes = new Proyecto();
            $proyectoAntes->fill($proyectoOriginal);
            $proyectoAntes->id = $proyectoOriginal['id'];

            // Actualizar los datos
            $proyectoActualizado = $proyectoOriginal;
            $proyectoActualizado['nombre'] = $nombre;
            $proyectoActualizado['fecha_inicio'] = $fecha_inicio;
            $proyectoActualizado['estado'] = $estado;
            $proyectoActualizado['responsable'] = $responsable;
            $proyectoActualizado['monto'] = $monto;

            // Crear instancia del proyecto después de actualizar
            $proyectoDespues = new Proyecto();
            $proyectoDespues->fill($proyectoActualizado);
            $proyectoDespues->id = $proyectoActualizado['id'];

            // Guardar en sesión
            session(['proyectos' => collect($proyectos)->map(function ($p) use ($proyectoActualizado) {
                return $p['id'] == $proyectoActualizado['id'] ? $proyectoActualizado : $p;
            })->values()->all()]);

            return view('proyectos.actualizarid', [
                'proyectoAntes' => $proyectoAntes,
                'proyectoDespues' => $proyectoDespues
            ]);
        } catch (\Exception $e) {
            return view('proyectos.actualizarid', [
                'proyectoAntes' => null,
                'proyectoDespues' => null,
                'error' => 'Error al actualizar proyecto: ' . $e->getMessage()
            ]);
        }
    }

     //-------------   5 .- Mostrar los proyectos por ID - listo-----------------------
    public function ctrlerMostrarProyectoId($id)
    {
        try {
            $proyectos = session('proyectos', []);
            $proyecto = collect($proyectos)->firstWhere('id', $id);
            
            if (!$proyecto) {
                return view('proyectos.mostrarid', [
                    'proyecto' => null,
                    'error' => 'Proyecto no encontrado'
                ]);
            }                    
            $proyectoModelo = new Proyecto();
            $proyectoModelo->fill($proyecto);
            $proyectoModelo->id = $proyecto['id'];
            
            return view('proyectos.mostrarid', [
                'proyecto' => $proyectoModelo
            ]);
        } catch (\Exception $e) {
            return view('proyectos.mostrarid', [
                'proyecto' => null,
                'error' => 'Error al mostrar proyecto: ' . $e->getMessage()
            ]);
        }
    }
}


