<?php

    class Empleado {
        
        protected $nombre;
        protected $id_empleado;
        protected $salario_base;

        public function __construct($nombre, $id_empleado, $salario_base) {
            $this->nombre = $nombre;
            $this->id_empleado = $id_empleado;
            $this->salario_base = $salario_base;
        }

        // Métodos getter y setter
        public function get_nombre() {
            return $this->nombre;
        }

        public function set_nombre($nombre) {
            $this->nombre = $nombre;
        }

        public function get_id_empleado() {
            return $this->id_empleado;
        }

        public function set_id_empleado($id_empleado) {
            $this->id_empleado = $id_empleado;
        }

        public function get_salario_base() {
            return $this->salario_base;
        }

        public function set_salario_base($salario_base) {
            $this->salario_base = $salario_base;
        }
    }

?>
