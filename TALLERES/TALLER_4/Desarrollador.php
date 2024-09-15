<?php

    require_once 'Empleado.php';
    require_once 'Evaluable.php';

    class Desarrollador extends Empleado implements Evaluable {
        private $lenguaje_principal;
        private $nivel_experiencia;

        public function __construct($nombre, $id_empleado, $salario_base, $lenguaje_principal, $nivel_experiencia) {
            parent::__construct($nombre, $id_empleado, $salario_base);
            $this->lenguaje_principal = $lenguaje_principal;
            $this->nivel_experiencia = $nivel_experiencia;
        }

        public function get_lenguaje_principal() {
            return $this->lenguaje_principal;
        }

        public function set_lenguaje_principal($lenguaje_principal) {
            $this->lenguaje_principal = $lenguaje_principal;
        }

        public function get_nivel_experiencia() {
            return $this->nivel_experiencia;
        }

        public function set_nivel_experiencia($nivel_experiencia) {
            $this->nivel_experiencia = $nivel_experiencia;
        }

        public function evaluar_desempenio() {
            // Lógica para evaluar el desempeño de un desarrollador
            return "El desempeño del desarrollador " . $this->nombre . " ha sido evaluado.";
        }

        public function calcular_salario_total() {
            return $this->salario_base;
        }
    }

?>
