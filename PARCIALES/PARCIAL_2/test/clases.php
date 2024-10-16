<?php

    abstract class RecursoBiblioteca implements Prestable {
        
        public $id;
        public $titulo;
        public $autor;
        public $anioPublicacion;
        public $estado;
        public $fechaAdquisicion;
        public $tipo;

        public function __construct($datos) {
            foreach ($datos as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
        
    }

    // Implementar las clases Libro, Revista y DVD aquí

    interface Prestable {

        public function obtenerDetallesPrestamo(): string;

    }



    class GestorBiblioteca {

        private $recursos = [];

        public function cargarRecursos() {
            $json = file_get_contents('biblioteca.json');
            $data = json_decode($json, true);
            
            
            foreach ($data as $recursoData) {
                switch ($recursoData['tipo']) {
                    case 'Libro';
                    $recurso = new Libro($recursoData);
                        break;
                    case 'Revista';
                    $recurso = new Libro($recursoData);
                        break;
                    case 'DVD';
                    $recurso = new Libro($recursoData);
                        break;
                } 
                $this->recursos[] = $recurso;
            }
            
            return $this->recursos;

        }

        // Implementar los demás métodos aquí


        public function agregarRecursos(RecursoBiblioteca  $recurso){

        // Añadir el nuevo recurso al array
           $this->recursos[] = $recurso;
        
           return $this-> recursos;

        }


        public function actualizarRecurso (RecursoBiblioteca $recurso){

            
        }

        public function actualizarEstadoRecurso ($id, $nuevoEstado){
           
            $array_temporal = $this->recursos;

            foreach ($array_temporal as $recurso){

                if ($recurso->id === $id) {
                    
                    $recurso-> estado = $nuevoEstado;
        
                }
            }
        
            return $array_temporal;

        }

        public function eliminarRecurso($id){


            $eliminar = array_filter($this -> recursos, function ($que_es_esto) use ($id){

                $resultado = $que_es_esto -> id == $id;

                return !$resultado;

            });

            return $eliminar;

        }
    

        public function buscarRecursosPorEstados($estado){

            $filtro = array_filter( $this -> recursos, function ($que_es_esto) use ($estado){
              
               return $que_es_esto -> estado == $estado;

            });

            return $filtro;

        }

    }


    class Libro extends RecursoBiblioteca{

        public function obtenerDetallesPrestamo(): string{

            return "";
            
        }

    }

    class Revista extends RecursoBiblioteca {
        
        public function obtenerDetallesPrestamo(): string {

            return "";
            
        }


    }

    class DVD extends RecursoBiblioteca {

        public function obtenerDetallesPrestamo(): string {

            return "";
            
        }

    }

?>


