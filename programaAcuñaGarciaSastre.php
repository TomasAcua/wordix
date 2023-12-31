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
//array $coleccionPalabras
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
//string $nombreJugador, $palabraAdivinar, $palabraNueva, $palabraAleatoria
//boolean $siPalabra
//array $palabrasWordix,$partidasGuardadas, $partida
//int $opcion, $totalPalabrasWordix, $numeroElegido, $numeroPartida, $indiceAleatorio, $cantPartidas

//Inicialización de variables:
$palabrasWordix=cargarColeccionPalabras();
$siPalabra=false;
$partidasGuardadas = [];
$partidasGuardadas = cargarPartidas();


//Proceso:

do {
    $opcion = seleccionarOpcion();
    $totalPalabrasWordix = count($palabrasWordix);
    $cantPartidas= count($partidasGuardadas);
    switch ($opcion) {
        case 1:
            // Implementar la lógica para jugar con una palabra elegida
            
            echo"ingrese su nombre: \n";
            $nombreJugador = trim(fgets(STDIN));
                echo"ingrese el numero de palabra entre 1 y $totalPalabrasWordix para jugar: \n";
                $numeroElegido =trim(fgets(STDIN));
                if ($numeroElegido>=1 && $numeroElegido <= $totalPalabrasWordix){
                    $numeroElegido = $numeroElegido-1;
                    $palabraAdivinar = $palabrasWordix[$numeroElegido];
                    if(jugadorYaJugoConPalabra($nombreJugador,$palabraAdivinar,$partidasGuardadas)){
                        echo"ya jugaste con esta palabra\n";
                    }else{
                        $partidasGuardadas[count($partidasGuardadas)]=jugarWordix($palabraAdivinar, $nombreJugador) ;
                    }
                }else{
                echo"OJO, tiene que ingresar un valor entre 1 y $totalPalabrasWordix \n";
            }
            break;
        case 2:
            // Implementar la lógica para jugar con una palabra aleatoria
            echo "Ingrese su nombre: \n";
            $nombreJugador = trim(fgets(STDIN));
            $indiceAleatorio = array_rand($palabrasWordix);
            $palabraAleatoria = $palabrasWordix[$indiceAleatorio];
            while (jugadorYaJugoConPalabra($nombreJugador,$indiceAleatorio,$partidasGuardadas)){
                $indiceAleatorio = array_rand($palabrasWordix);
                $palabraAleatoria = $palabrasWordix[$indiceAleatorio];
            }
                    $partidasGuardadas[count($partidasGuardadas)]=jugarWordix($palabraAleatoria, $nombreJugador);
                  
            break;
        case 3:
            // Implementar la lógica para mostrar una partida específica
            
            echo "ingrese el numero de partida que quiere ver entre 1 y $cantPartidas \n";
            $numeroPartida = trim(fgets(STDIN));
            $numeroPartida = $numeroPartida-1;

            if($numeroPartida>=count($partidasGuardadas)|| $numeroPartida<0){
                echo "la partida no se encontro\n";
            }
            else{
                 mostrarPartida($partidasGuardadas[$numeroPartida],$numeroPartida);
                }

            break;
        case 4:
            echo "Ingrese el nombre del jugador: \n";
            $nombreJugador=trim(fgets(STDIN));
            $partida=primeraGanada($nombreJugador,$partidasGuardadas);
            if ($partida == -1) {
                echo "El jugador $nombreJugador no ha ganado ninguna partida.\n";
            } elseif($partida == -2 ) {
                echo "El jugador $nombreJugador no existe.\n";
            }else{
                echo "***********************************\n Partida Wordix: Palabra {$partida["palabraWordix"]}\n Jugador: $nombreJugador\n Puntaje: {$partida["puntaje"]}\n Intento: {$partida["intentos"]}\n***********************************\n ";
            }
            break;
        case 5:
                // Implementar la lógica para mostrar el resumen de un jugador
                //boolean $jugadorEncontrado
                //int $indicePartida
                //array $datos
                echo ("Ingrese el nombre del jugador que desea chequear: ");
                $nombreJugador = trim(fgets(STDIN));
            
                $jugadorEncontrado = false;
                $indicePartida = 0;
            
                while ($indicePartida < count($partidasGuardadas) && !$jugadorEncontrado) {
                    $partida = $partidasGuardadas[$indicePartida];
                    
                    if ($nombreJugador == $partida["jugador"]) {
                        $jugadorEncontrado = true;
                    }
            
                    $indicePartida++;
                }
            
                if (!$jugadorEncontrado) {
                    echo "El jugador $nombreJugador no existe.\n";
                } else {
                    $datos = estadisticasJugador($nombreJugador, $partidasGuardadas);
                    mostrarResumen($datos);
                }
                break;
        case 6:
            // Implementar la lógica para mostrar el listado de partidas ordenadas por jugador y palabra
            mostrarOrdenado($partidasGuardadas);
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
            $palabrasWordix= agregarPalabra( $palabrasWordix,$palabraNueva);
            break;
        case 8:
            echo "¡Hasta luego!";
            break;
        default:
            echo "Opción no válida. Por favor, ingrese una opción válida.\n";
    }
 }while ($opcion!= 8);
 