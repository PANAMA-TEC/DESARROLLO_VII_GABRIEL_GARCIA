<?php

    require_once 'Gerente.php';
    require_once 'Desarrollador.php';

    class Empresa {
        private $empleados = [];

        public function agregar_empleado(Empleado $empleado) {
            $this->empleados[] = $empleado;
        }

        public function listar_empleados() {
            foreach ($this->empleados as $empleado) {
                echo "ID: " . $empleado->get_id_empleado() . " - Nombre: " . $empleado->get_nombre() . "\n";
            }
        }

        public function calcular_nomina_total() {
            $total = 0;
            foreach ($this->empleados as $empleado) {
                if ($empleado instanceof Gerente) {
                    $total += $empleado->calcular_salario_total();
                } elseif ($empleado instanceof Desarrollador) {
                    $total += $empleado->calcular_salario_total();
                }
            }
            return $total;
        }

        public function evaluar_desempenio_empleados() {
            foreach ($this->empleados as $empleado) {
                if ($empleado instanceof Evaluable) {
                    echo $empleado->evaluar_desempenio() . "\n";
                }
            }
        }
    }

?>
