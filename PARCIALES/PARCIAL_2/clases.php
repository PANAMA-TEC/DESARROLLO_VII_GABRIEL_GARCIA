<?php
// Archivo: clases.php

class Tarea {
    public $id;
    public $titulo;
    public $descripcion;
    public $estado;
    public $prioridad;
    public $fechaCreacion;
    public $tipo;
    public $detallesEspecificos;


    public function __construct($datos) {
        foreach ($datos as $key => $value) {
            $this->$key = $value;
        }
    }

    // Implementar estos getters
    // public function getEstado() { }
    // public function getPrioridad() { }
}

class GestorTareas {
    private $tareas = [];

    public function cargarTareas() {
        
        $json = file_get_contents('tareas.json');
        $data = json_decode($json, true);
        
        print_r($data);
        
        foreach ($data as $tareaData) {
            $tarea = new Tarea($tareaData);
            $this->tareas[] = $tarea;
        }
        
        return $this->tareas;
    }


    public function agregarTarea($tarea) {

    }

    public function eliminarTarea($id) {
       
        $tareas = $this->tareas;
   
        foreach ($tareas as $key => $tarea) {
            if ($tarea['id'] === $id) {
                unset($tareas[$key]);
                $this->tareas = array_values($tareas);
             return  true;
            }
        }
        return false;
    }

    public function actualizarEstadoTarea($id, $nuevoEstado)  {
        $tareas = $this->tareas;
 
        foreach ($tareas as &$tarea) {
            if ($tarea['id'] === $id) {
                $tarea['estado'] = $nuevoEstado;
                return true;
            }
        }
        return false;
    }

    // public function actualizarEstadoTarea($id, $nuevoEstado)  {

    // }

    public function buscarTareasPorEstado($estado)  {
        $tareas = $this->tareas;
        $tareasFiltradas = [];
   
        foreach ($tareas as $tarea) {
            if ($tarea['estado'] === $estado) {
                $tareasFiltradas[] = $tarea;
            }
        }
   
        return $tareasFiltradas;
    }

    // public function listarTareas($filtroEstado = '')  {
        
    // }

    

}

interface Detalle {
    public function obtenerDetallesEspecificos();
}

class TareaDesarrollo extends Tarea implements Detalle{

    private $lenguajeProgramacion = '';

    public function obtenerDetallesEspecificos() {
        return $this-> detallesEspecifico;
    }



}



class TareaDiseno extends Tarea implements Detalle{

    private $herramientaDiseno = '';

    public function obtenerDetallesEspecificos() {
        return $this-> detallesEspecifico;
    }
    
}


class TareaTesting extends Tarea implements Detalle{
    
   private $tipoTest = '' ;

  public function obtenerDetallesEspecificos() {
     return $this-> detallesEspecifico;
  }
}
// Implementar:
// 1. La interfaz Detalle
// 2. Modificar la clase Tarea para implementar la interfaz Detalle
// 3. Las clases TareaDesarrollo, TareaDiseno y TareaTesting que hereden de Tarea