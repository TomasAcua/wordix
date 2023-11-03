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
//string nombreJugador, $palabrasAdivinar, $palabraNueva
//boolean $siPalabra

//Inicialización de variables:
$palabrasWordix=cargarColeccionPalabras();
$palabrasUtilizadas=[];
$siPalabra=false;

//Proceso:

do {
    $opcion = seleccionarOpcion();
    $totalPalabrasWordix = count($palabrasWordix);
    switch ($opcion) {
        case 1:
            // Implementar la lógica para jugar con una palabra elegida
            echo"ingrese su nombre: \n";
            $nombreJugador = trim(fgets(STDIN));
            echo"ingrese el numero de palabra entre 1 y $totalPalabrasWordix para jugar: \n";
            $numeroElegido =trim(fgets(STDIN)) -1 ;
            if ($numeroElegido>=0 && $numeroElegido < $totalPalabrasWordix){
                $palabraAdivinar = $palabrasWordix[$numeroElegido];
                jugarWordix($palabraAdivinar, $nombreJugador) ;
            }else{
                echo"OJO, tiene que ingresar un valor entre 1 y $totalPalabrasWordix \n";}
                $palabrasUtilizadas[] = $palabraAdivinar;
            break;
        case 2:
            // Implementar la lógica para jugar con una palabra aleatoria
            echo "Ingrese su nombre: \n";
            $nombreJugador = trim(fgets(STDIN));
                if (count($palabrasUtilizadas) === count($palabrasWordix)) {
                     echo "Todas las palabras ya se han utilizado en juegos anteriores.\n";
                 } else { 
                 do {
                   $indiceAleatorio = array_rand($palabrasWordix);
                 } while (in_array($indiceAleatorio, $palabrasUtilizadas)); // Evitar palabras ya utilizadas

                     $palabraAleatoria = $palabrasWordix[$indiceAleatorio];
                    
                     $palabrasUtilizadas[] = $indiceAleatorio;//esto esta mal, hay que hacer un arreglo por jugador o chequear antes

                    jugarWordix($palabraAleatoria, $nombreJugador);
                  }
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
            // se pide una palabra, si la palabra ya esta dentro de la coleccion se vuevle a pedir otra
           
            do{
                if($siPalabra){
                    echo "la palabra que ingreso ya esta en la lista\n";
                }
            $palabraNueva=leerPalabra5Letras();
            $siPalabra= in_array($palabraNueva,$palabrasWordix);

            }while($siPalabra);//"in_array" recorre el arreglo y determina si el string esta o no dentro del arreglo
            $totalPalabrasWordix=count($palabrasWordix);
            $palabrasWordix[$totalPalabrasWordix]=$palabraNueva;
            echo "¡¡¡ La palabra a sido agregada exitosamente !!! \n";
            break;
        case 8:
            echo "¡Hasta luego!";
            break;
        default:
            echo "Opción no válida. Por favor, ingrese una opción válida.\n";
    }
 }while ($opcion!= 8);



//$partida = jugarWordix("MELON", strtolower("MaJo"));
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
