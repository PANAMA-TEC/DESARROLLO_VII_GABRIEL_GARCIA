<?php

    require_once 'Empresa.php';

    // Crear una empresa
    $empresa = new Empresa();

    // Crear empleados
    $gerente = new Gerente("Carlos", 101, 5000, "Ventas");
    $desarrollador1 = new Desarrollador("Ana", 102, 4000, "PHP", "Senior");
    $desarrollador2 = new Desarrollador("Luis", 103, 3500, "JavaScript", "Junior");

    // Asignar bono al gerente
    $gerente->asignar_bono(1000);

    // Agregar empleados a la empresa
    $empresa->agregar_empleado($gerente);
    $empresa->agregar_empleado($desarrollador1);
    $empresa->agregar_empleado($desarrollador2);

    // Listar empleados
    echo "Lista de empleados:\n";
    $empresa->listar_empleados();

    // Calcular nómina total
    echo "\nLa nómina total es: " . $empresa->calcular_nomina_total() . "\n";

    // Evaluar desempeño de los empleados
    echo "\nEvaluación de desempeño:\n";
    $empresa->evaluar_desempenio_empleados();

?>
