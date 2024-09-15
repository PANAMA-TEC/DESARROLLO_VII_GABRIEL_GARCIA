<?php

    require_once 'Empleado.php';
    require_once 'Evaluable.php';

    class Gerente extends Empleado implements Evaluable {
        private $departamento;
        private $bono;

        public function __construct($nombre, $id_empleado, $salario_base, $departamento) {
            parent::__construct($nombre, $id_empleado, $salario_base);
            $this->departamento = $departamento;
            $this->bono = 0;
        }

        public function asignar_bono($bono) {
            $this->bono = $bono;
        }

        public function get_departamento() {
            return $this->departamento;
        }

        public function set_departamento($departamento) {
            $this->departamento = $departamento;
        }


  
        public function evaluar_desempenio() {
            // Lógica para evaluar el desempeño de un gerente
            return "El desempeño del gerente " . $this->nombre . " ha sido evaluado.";
        }

        public function calcular_salario_total() {
            return $this->salario_base + $this->bono;
        }
    


    }

?>
