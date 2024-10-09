<?php
    // Incluir archivos necesarios
    require_once './SistemaGestionEstudiantes.php';

    // Crear una instancia del sistema de gestión de estudiantes
    $sistema = new SistemaGestionEstudiantes();

    // Crear y agregar estudiantes
    $sistema->agregarEstudiante(new Estudiante(1, "Juan Perez", 20, "Ingeniería"));
    $sistema->agregarEstudiante(new Estudiante(2, "Ana Gomez", 22, "Derecho"));
    $sistema->agregarEstudiante(new Estudiante(3, "Luis Martinez", 21, "Medicina"));

    // Agregar materias y calificaciones a los estudiantes
    $sistema->obtenerEstudiante(1)->agregarMateria("Matemáticas", 85);
    $sistema->obtenerEstudiante(1)->agregarMateria("Física", 90);
    $sistema->obtenerEstudiante(2)->agregarMateria("Derecho Civil", 80);
    $sistema->obtenerEstudiante(2)->agregarMateria("Derecho Penal", 75);
    $sistema->obtenerEstudiante(3)->agregarMateria("Anatomía", 88);
    $sistema->obtenerEstudiante(3)->agregarMateria("Fisiología", 92);

    // Mostrar reporte de rendimiento
    print_r($sistema->generarReporteRendimiento());

    // Listar estudiantes
    print_r($sistema->listarEstudiantes());

    // Buscar estudiante por carrera
    print_r($sistema->buscarEstudiante("ingeniería"));

    // Graduar a un estudiante
    $sistema->graduarEstudiante(1);
    print_r($sistema->listarEstudiantes());
?>