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
//int $opcion, $totalPalabrasWordix, $numeroElegido, $numeroPartida, $indiceAleatorio

//Inicialización de variables:
$palabrasWordix=cargarColeccionPalabras();
$siPalabra=false;
$partidasGuardadas = [];
$partidasGuardadas = cargarPartidas();

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
            echo "ingrese el numero de partida que quiere ver\n";
            $numeroPartida = trim(fgets(STDIN));
            $numeroPartida = $numeroPartida-1;
            if($numeroPartida>count($partidasGuardadas)|| $numeroPartida<0){
                echo "la partida no se encontro\n";
            }
            else{
                $partida = $partidasGuardadas[$numeroPartida];
                echo "Partida WORDIX $numeroPartida: palabra {$partida['palabraWordix']}\n";
                echo "Jugador: {$partida['jugador']}\n";
                 echo "Puntaje: {$partida['puntaje']} puntos\n";
                 if ($partida['intentos'] > 0) {
                     echo "Intento: Adivinó la palabra en {$partida['intentos']} intentos\n";
                    } else {
                     echo "Intento: No adivinó la palabra\n";
                 }
                }

            break;
        case 4:
            echo "Ingrese el nombre del jugador: \n";
            $nombreJugador=trim(fgets(STDIN));
            $partida=primeraGanada($nombreJugador,$partidasGuardadas);
            if ($partida !== -1) {
                echo "***********************************\n Partida Wordix: Palabra {$partida["palabraWordix"]}\n Jugador: $nombreJugador\n Puntaje: {$partida["puntaje"]}\n Intento: {$partida["intentos"]}\n***********************************\n ";
            } else {
                echo "El jugador $nombreJugador no ha ganado ninguna partida.\n";
            }
            break;
        case 5:
                // Implementar la lógica para mostrar el resumen de un jugador
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
                    echo "El jugador $nombreJugador aún no ha jugado ninguna partida.\n";
                } else {
                    $datos = estadisticasJugador($nombreJugador, $partidasGuardadas);
                    echo("************************************\n");
                    echo("Jugador: $datos[jugador]\n");
                    echo("Partidas: $datos[cantPartidas]\n");
                    echo("Puntaje Total: $datos[totalPuntaje]\n");
                    echo("Porcentaje de victorias: $datos[porcentajeVictorias]\n");
                    echo("Adivinadas: $datos[victorias]\n");
                    echo("      Intento 1: $datos[int1]\n      Intento 2: $datos[int2]\n      Intento 3: $datos[int3]\n      Intento 4: $datos[int4]\n      Intento 5: $datos[int5]\n      Intento 6: $datos[int6]\n");
                    echo("************************************\n");
                }
                break;
        case 6:
            // Implementar la lógica para mostrar el listado de partidas ordenadas por jugador y palabra
            uasort($partidasGuardadas, 'compararPartidas');

            echo "Listado de partidas ordenadas por jugador y por palabra:\n";
            print_r($partidasGuardadas);
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
 