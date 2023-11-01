<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/*# integrantes del grupo
**Acuña Tomas Nahuel** Legajo: fai-2510 - Email: tomas.acua@est.fi.uncoma.edu.ar - Github: TomasAcuna
**Facudno Ezequiel Garcia** Legajo: FAI-2911 - Email: facundo.garcia@est.fi.uncoma.edu.ar - Github:FacuGarcia05/*


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "SILLA", "LAPIZ", "BRUMA", "RATON", "CABLE",
    ];

    return ($coleccionPalabras);
}

/* ****COMPLETAR***** */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:
do {
    // Mostrar el menú de opciones
    echo "Menú de opciones:\n";
    echo "1) Jugar al wordix con una palabra elegida\n";
    echo "2) Jugar al wordix con una palabra aleatoria\n";
    echo "3) Mostrar una partida\n";
    echo "4) Mostrar la primer partida ganadora\n";
    echo "5) Mostrar resumen de Jugador\n";
    echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra\n";
    echo "7) Agregar una palabra de 5 letras a Wordix\n";
    echo "8) Salir\n";

    // Solicitar la opción al usuario
    echo "Ingrese su opción: ";
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1:
            // Implementar la lógica para jugar con una palabra elegida
            // ...
            break;
        case 2:
            // Implementar la lógica para jugar con una palabra aleatoria
            // ...
            break;
        case 3:
            // Implementar la lógica para mostrar una partida específica
            // ...
            break;
        case 4:
            // Implementar la lógica para mostrar la primer partida ganadora de un jugador
            // ...
            break;
        case 5:
            // Implementar la lógica para mostrar el resumen de un jugador
            // ...
            break;
        case 6:
            // Implementar la lógica para mostrar el listado de partidas ordenadas por jugador y palabra
            // ...
            break;
        case 7:
            // Implementar la lógica para agregar una palabra de 5 letras a Wordix
            // ...
            break;
        case 8:
            echo "¡Hasta luego!";
            break;
        default:
            echo "Opción no válida. Por favor, ingrese una opción válida.\n";
    }

} while ($opcion != 8);

$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
