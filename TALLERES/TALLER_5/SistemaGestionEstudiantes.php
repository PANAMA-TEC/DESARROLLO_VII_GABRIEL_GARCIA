<?php
    require_once 'Estudiante.php';

    class SistemaGestionEstudiantes {
        private array $estudiantes = [];
        private array $graduados = [];

        public function agregarEstudiante(Estudiante $estudiante): void {
            $this->estudiantes[$estudiante->obtenerDetalles()['id']] = $estudiante;
        }

        public function obtenerEstudiante(int $id): ?Estudiante {
            return $this->estudiantes[$id] ?? null;
        }

        public function listarEstudiantes(): array {
            return $this->estudiantes;
        }

        public function calcularPromedioGeneral(): float {
            $totalPromedios = array_map(fn($est) => $est->obtenerPromedio(), $this->estudiantes);
            return array_sum($totalPromedios) / count($totalPromedios);
        }

        public function obtenerEstudiantesPorCarrera(string $carrera): array {
            return array_filter($this->estudiantes, fn($est) => $est->obtenerDetalles()['carrera'] === $carrera);
        }

        public function obtenerMejorEstudiante(): ?Estudiante {
            if (empty($this->estudiantes)) return null;
            return array_reduce($this->estudiantes, fn($mejor, $actual) => $actual->obtenerPromedio() > $mejor->obtenerPromedio() ? $actual : $mejor);
        }

        public function generarReporteRendimiento(): array {
            $reporte = [];
            foreach ($this->estudiantes as $estudiante) {
                foreach ($estudiante->obtenerDetalles()['materias'] as $materia => $calificacion) {
                    if (!isset($reporte[$materia])) {
                        $reporte[$materia] = ['total' => 0, 'cantidad' => 0, 'max' => 0, 'min' => 100];
                    }
                    $reporte[$materia]['total'] += $calificacion;
                    $reporte[$materia]['cantidad']++;
                    $reporte[$materia]['max'] = max($reporte[$materia]['max'], $calificacion);
                    $reporte[$materia]['min'] = min($reporte[$materia]['min'], $calificacion);
                }
            }
            foreach ($reporte as &$datos) {
                $datos['promedio'] = $datos['total'] / $datos['cantidad'];
            }
            return $reporte;
        }

        public function graduarEstudiante(int $id): void {
            if (isset($this->estudiantes[$id])) {
                $this->graduados[$id] = $this->estudiantes[$id];
                unset($this->estudiantes[$id]);
            }
        }

        public function generarRanking(): array {
            usort($this->estudiantes, fn($a, $b) => $b->obtenerPromedio() <=> $a->obtenerPromedio());
            return $this->estudiantes;
        }

        public function buscarEstudiante(string $termino): array {
            $termino = strtolower($termino);
            return array_filter($this->estudiantes, fn($est) => 
                strpos(strtolower($est->obtenerDetalles()['nombre']), $termino) !== false ||
                strpos(strtolower($est->obtenerDetalles()['carrera']), $termino) !== false
            );
        }

        public function obtenerEstadisticasPorCarrera(): array {
            $estadisticas = [];
            foreach ($this->estudiantes as $estudiante) {
                $carrera = $estudiante->obtenerDetalles()['carrera'];
                if (!isset($estadisticas[$carrera])) {
                    $estadisticas[$carrera] = ['total_estudiantes' => 0, 'promedio_general' => 0, 'mejor_estudiante' => null];
                }
                $estadisticas[$carrera]['total_estudiantes']++;
                $estadisticas[$carrera]['promedio_general'] += $estudiante->obtenerPromedio();
                if (is_null($estadisticas[$carrera]['mejor_estudiante']) || 
                    $estudiante->obtenerPromedio() > $estadisticas[$carrera]['mejor_estudiante']->obtenerPromedio()) {
                    $estadisticas[$carrera]['mejor_estudiante'] = $estudiante;
                }
            }
            foreach ($estadisticas as &$datos) {
                $datos['promedio_general'] /= $datos['total_estudiantes'];
            }
            return $estadisticas;
        }
    }
?>