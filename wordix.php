<?php


/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
/**************************************/
const CANT_INTENTOS = 6;

/*
    disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * @param int $min,$max
 * @return int
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero

    $numero = trim(fgets(STDIN));

    if (is_numeric($numero)) { //determina si un string es un número. puede ser float como entero.
        $numero  = $numero * 1; //con esta operación convierto el string en número.
    }
    while (!(is_numeric($numero) && (($numero == (int)$numero) && ($numero >= $min && $numero <= $max)))) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
        if (is_numeric($numero)) {
            $numero  = $numero * 1;
        }
    }
    return $numero;
}

/**
 * Escrbir un texto en color ROJO
 * @param string $texto)
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Escrbir un texto en color VERDE
 * @param string $texto)
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Escrbir un texto en color AMARILLO
 * @param string $texto)
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Escrbir un texto en color GRIS
 * @param string $texto)
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Escrbir un texto pantalla.
 * @param string $texto)
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/**
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto
 * @param string $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/**
 * @param int $usuario
 * @return void
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}


/**
 * @param string $cadena
 * @return boolean 
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        $i++;
    }
    return $esLetra;
}

/**
 * pide una palabra de cinco letras, si es de cinco letras la retorna sino vuelve a pedir otra
 *  @return string
 */
function leerPalabra5Letras(){
    //string $palabra
    echo "Ingrese una palabra de 5 letras:\n ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra);

    while ((strlen($palabra) != 5) || !esPalabra($palabra)) {
        echo "Debe ingresar una palabra de 5 letras:  \n";
        $palabra = strtoupper(trim(fgets(STDIN)));
    }
    return $palabra;
}


/**
 * Inicia una estructura de datos Teclado. La estructura es de tipo: ¿Indexado, asociativo o Multidimensional?
 *@return array
 */
function iniciarTeclado()
{
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, "Ñ" => ESTADO_LETRA_DISPONIBLE,
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/**
 * Escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado
 */
function escribirTeclado($teclado)
{
    //array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
    //string $letra, $estado
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }
    echo "\n";
};


/**
 * Escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @param array $estruturaIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    //$cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        echo "\n" . ($i + 1) . ")  ";
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }
        echo "\n";
    }

    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
        echo "\n";
    }
    //echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/**
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix
 * @param array $estruturaIntentosWordix
 * @param string $palabraIntento
 * @return array estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento)
{
    $cantCaracteres = strlen($palabraIntento);
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */
    for ($i = 0; $i < $cantCaracteres; $i++) {
        $letraIntento = $palabraIntento[$i];
        $posicion = strpos($palabraWordix, $letraIntento);
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA;
        } else {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;
            } else {
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]);
    }

    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);
    return $estruturaIntentosWordix;
}

/**
 * Actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado
 * @param array $estructuraPalabraIntento
 * @return array el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento)
{
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @param array $estructuraPalabraIntento
 * @return bool
 */
function esIntentoGanado($estructuraPalabraIntento){
    // int $i, $cantLetras
    //bool $ganado
    $cantLetras = count($estructuraPalabraIntento);
    $i = 0;

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 *  Calcula el puntaje obtenido por el jugador en un intento de Wordix.
 * @param int $nroIntento Número del intento (entre 1 y 6).
 * @param string $palabraIntento Palabra intento del jugador en mayúsculas.
 * @return int Puntaje obtenido en el intento.
 */
function obtenerPuntajeWordix($nroIntento, $palabraIntento){ 
    // int $puntaje 
    //array puntajeLetras
    $puntaje= 7-$nroIntento;
    $puntajesLetras = [
        'A' => 1, 'E' => 1, 'I' => 1, 'O' => 1, 'U' => 1,
        'B' => 2, 'C' => 2, 'D' => 2, 'F' => 2, 'G' => 2, 'H' => 2, 'J' => 2, 'K' => 2, 'L' => 2, 'M' => 2,
        'N' => 3, 'Ñ' => 3, 'P' => 3, 'Q' => 3, 'R' => 3, 'S' => 3, 'T' => 3, 'V' => 3, 'W' => 3, 'X' => 3, 'Y' => 3, 'Z' => 3
    ];
    foreach (str_split($palabraIntento) as $letra) {
            $puntaje = $puntaje + $puntajesLetras[$letra];
        }

    
    return $puntaje ;
}

/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario)
{
    /*Inicialización*/
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    escribirMensajeBienvenida($nombreUsuario);
    $nroIntento = 1;
    do {

        echo "Comenzar con el Intento " . $nroIntento . ":\n";
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento - 1;
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */

        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);


    if ($ganoElIntento) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix($nroIntento, $palabraIntento);
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos!\n";
    } else {
        $nroIntento = 0; //reset intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}
/**
 * se cargan ejemplos de partidas
 * @return array 
 */
function cargarPartidas(){
    //array $ejemploPartidas
    $coleccion = [];
$pa1 = ["palabraWordix" => "SUECO", "jugador" => "kleiton", "intentos" => 0, "puntaje" => 0];
$pa2 = ["palabraWordix" => "YUYOS", "jugador" => "briba", "intentos" => 0, "puntaje" => 0];
$pa3 = ["palabraWordix" => "HUEVO", "jugador" => "zrack", "intentos" => 3, "puntaje" => 9];
$pa4 = ["palabraWordix" => "TINTO", "jugador" => "cabrito", "intentos" => 4, "puntaje" => 8];
$pa5 = ["palabraWordix" => "RASGO", "jugador" => "briba", "intentos" => 0, "puntaje" => 0];
$pa6 = ["palabraWordix" => "VERDE", "jugador" => "cabrito", "intentos" => 5, "puntaje" => 7];
$pa7 = ["palabraWordix" => "CASAS", "jugador" => "kleiton", "intentos" => 5, "puntaje" => 7];
$pa8 = ["palabraWordix" => "GOTAS", "jugador" => "kleiton", "intentos" => 0, "puntaje" => 0];
$pa9 = ["palabraWordix" => "ZORRO", "jugador" => "zrack", "intentos" => 4, "puntaje" => 8];
$pa10 = ["palabraWordix" => "GOTAS", "jugador" => "cabrito", "intentos" => 0, "puntaje" => 0];
$pa11 = ["palabraWordix" => "FUEGO", "jugador" => "cabrito", "intentos" => 2, "puntaje" => 10];
$pa12 = ["palabraWordix" => "TINTO", "jugador" => "briba", "intentos" => 0, "puntaje" => 0];

array_push($coleccion, $pa1, $pa2, $pa3, $pa4, $pa5, $pa6, $pa7, $pa8, $pa9, $pa10, $pa11, $pa12);
return $coleccion;
    /*$ejemploPartidas = [];
        $partida01 = [ "palabraWordix" => "QUESO", "jugador" => "Emilia",  "intentos" => 0, "puntaje" => 0];
        $partida02 = [ "palabraWordix" => "CASAS", "jugador" => "Adriano", "intentos" => 3, "puntaje" => 14];
        $partida03 = [ "palabraWordix" => "MUJER", "jugador" => "Facu", "intentos" => 2, "puntaje" => 13];
        $partida04 = [ "palabraWordix" => "VERDE", "jugador" => "Eva", "intentos" => 2, "puntaje" => 15];
        $partida05 = [ "palabraWordix" => "GATOS", "jugador" => "Tomi", "intentos" => 5, "puntaje" => 12];
        $partida06 = [ "palabraWordix" => "SILLA", "jugador" => "Agus", "intentos" => 1, "puntaje" => 15];
        $partida07 = [ "palabraWordix" => "LAPIZ", "jugador" => "Ludmi", "intentos" => 4, "puntaje" => 13];
        $partida08 = [ "palabraWordix" => "BRUMA", "jugador" => "Facu", "intentos" => 5, "puntaje" => 11];
        $partida09 = [ "palabraWordix" => "RATON", "jugador" => "Tomi", "intentos" => 4, "puntaje" => 14];
        $partida10 = [ "palabraWordix" => "PIANO", "jugador" => "Cristian", "intentos" => 6, "puntaje" => 0];

        array_push($ejemploPartidas, $partida01, $partida02, $partida03, $partida04, $partida05, $partida06, $partida07, $partida08, $partida09, $partida10);
        
    
    return $ejemploPartidas; */
}
/**  Muestra el menú de opciones
 * @return int
 */
function seleccionarOpcion(){
    // int $opcion
    //bool $opcionValida
    do{
      
        echo "Menú de opciones:\n";
        echo "1) Jugar al wordix con una palabra elegida\n";
        echo "2) Jugar al wordix con una palabra aleatoria\n";
        echo "3) Mostrar una partida\n";
        echo "4) Mostrar la primer partida ganadora\n";
        echo "5) Mostrar resumen de Jugador\n";
        echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra\n";
        echo "7) Agregar una palabra de 5 letras a Wordix\n";
        echo "8) Salir\n";
    
        echo "Ingrese su opción: ";
        $opcion = trim(fgets(STDIN));

        $opcionValida = false;
        if($opcion >= 1 && $opcion <= 8){
            $opcionValida = true; 
        } else{
            echo("Por favor, seleccione una opcion valida (1 al 8)");
        }
    }while($opcionValida = false);
    return $opcion;
}
/**
 * Función para verificar si un jugador ya ha jugado con una palabra específica
 *
 * @param string $nombre Nombre del jugador
 * @param string $palabra Palabra Wordix a verificar
 * @return bool True si el jugador ya jugó con la palabra, False si no
 */
function jugadorYaJugoConPalabra($nombre, $palabra,$partidasGuardadas) {
    //bool $jugoPartida
    $jugoPartida = false;
    $encontrado = false;
    $i = 0;
    while (!$encontrado && $i < count($partidasGuardadas)) {
        $partida = $partidasGuardadas[$i];

        if ($partida["palabraWordix"] == $palabra && $partida["jugador"] == $nombre) {
            $jugoPartida =  true; 
            $encontrado = true;
        }

        $i++;
    }
    return $jugoPartida;
}
/**
 * ingresa la palabra nueva y la coleccion de palabras, y retorna la coleccion de palabras con la palabra nueva
 * @param array $palabraWordix
 * @param string $palabraNueva
 * @return array
 */
function agregarPalabra($palabrasWordix,$palabraNueva){
    //entero $totalPalarbasWordix
    $totalPalabrasWordix=count($palabrasWordix);
            $palabrasWordix[$totalPalabrasWordix]=$palabraNueva;//preguntar si hay que mantenerlo entre ejecuciones
            echo "¡¡¡ La palabra a sido agregada exitosamente !!! \n";
        return $palabrasWordix;
}
/**
 * ingresa el nombre de jugador y las partidas guardadas, si el jugador ya jugo re retorna la info, sino se retorna un -1
 * @param string $nombreJugador
 * @param array $partidasGuardadas
 * @return array
 */
    function primeraGanada($nombreJugador, $partidasGuardadas){
    //array $primeraPartidaGanadora
    //boolean $encontrada
    //int $i
    
        $primeraPartidaGanadora = -2;
        $encontrada = false;
        $i = 0;
    
        while (!$encontrada && $i < count($partidasGuardadas)) {
            $partida = $partidasGuardadas[$i];
    
            if ($partida["jugador"] == $nombreJugador && $partida["puntaje"] > 0) {
                $primeraPartidaGanadora = $partida;
                $encontrada = true; 
            }elseif($partida["jugador"] == $nombreJugador && $partida["puntaje"] == 0){
                $primeraPartidaGanadora = -1;
                $encontrada = true;
            }
    
            $i++;
        }
    
        return $primeraPartidaGanadora;
    }

   /**
     * Función de comparación para uasort
     *
     * @param array $partida1 Primera partida a comparar
     * @param array $partida2 Segunda partida a comparar
     * @return int Resultado de la comparación (-1, 0, 1)
     */
    function compararPartidas($partida01, $partida02) {
        //int $numPartida
        $numPartida= 0;
        if ($partida01['jugador'] == $partida02['jugador']) {
            $numPartida = strcmp($partida01['palabraWordix'], $partida02['palabraWordix']);
        }else {
        $numPartida= strcmp($partida01['jugador'], $partida02['jugador']);
        }
        return $numPartida;
    }
    /*
    En esta funcion se muestran las estadisticas de el jugador ingresado
    @param string $jugadorNombre
    @param array $partidasGuardadas
    @return
    */
function estadisticasJugador($jugadorNombre, $partidasGuardadas){
    //int $cantPartidas, $totalPuntaje, $victorias, $porcentajeVictorias, $int1, $int2, $int3, int4, int5, int6
    //$cantPartidas = 0; $totalPuntaje = 0; $porcentajeVictorias = 0; $victorias = 0; $int1 = 0; $int2 = 0; $int3 = 0; $int4 = 0; $int5 = 0; $int6 = 0;
    $resumenjugador=[
        "jugador" => $jugadorNombre, "cantPartidas" => 0, "totalPuntaje" => 0, "victorias" => 0, "porcentajeVictorias" => 0,
        "int1" => 0, "int2" => 0, "int3" => 0, "int4" => 0, "int5" => 0, "int6" => 0
    ];
    foreach($partidasGuardadas as $partida){
        if($partida["jugador"] == $resumenjugador["jugador"]){
            $resumenjugador["cantPartidas"]++;
            if($partida["intentos"]== 1){
                $resumenjugador["int1"]++;
                $resumenjugador["victorias"]++;
                $resumenjugador["totalPuntaje"] = $resumenjugador["totalPuntaje"] + $partida["puntaje"];
            }elseif($partida["intentos"]== 2){
                $resumenjugador["int2"]++;
                $resumenjugador["victorias"]++;
                $resumenjugador["totalPuntaje"] = $resumenjugador["totalPuntaje"] + $partida["puntaje"];
            }elseif($partida["intentos"]== 3){
                $resumenjugador["int3"]++;
                $resumenjugador["victorias"]++;
                $resumenjugador["totalPuntaje"] = $resumenjugador["totalPuntaje"] + $partida["puntaje"];
            }elseif($partida["intentos"]== 4){
                $resumenjugador["int4"]++;
                $resumenjugador["victorias"]++;
                $resumenjugador["totalPuntaje"] = $resumenjugador["totalPuntaje"] + $partida["puntaje"];
            }elseif($partida["intentos"]== 5){
                $resumenjugador["int5"]++;
                $resumenjugador["victorias"]++;
                $resumenjugador["totalPuntaje"] = $resumenjugador["totalPuntaje"] + $partida["puntaje"];
            }elseif($partida["intentos"]== 6){
                if(esIntentoGanado($partida)){
                $resumenjugador["int6"]++;
                $resumenjugador["victorias"]++;
                $resumenjugador["totalPuntaje"] = $resumenjugador["totalPuntaje"] + $partida["puntaje"];
            }  
        }
            $resumenjugador["porcentajeVictorias"] = ($resumenjugador["victorias"] / $resumenjugador["cantPartidas"]) * 100;       
        } 
    }
return $resumenjugador;
}
function mostrarPartida ($partidaAMostrar,$numeroPartida){
    $numeroPartida = $numeroPartida+1;
    echo "Partida WORDIX $numeroPartida: palabra {$partidaAMostrar['palabraWordix']}\n";
    echo "Jugador: {$partidaAMostrar['jugador']}\n";
     echo "Puntaje: {$partidaAMostrar['puntaje']} puntos\n";
     if ($partidaAMostrar['intentos'] > 0) {
         echo "Intento: Adivinó la palabra en {$partidaAMostrar['intentos']} intentos\n";
        } else {
         echo "Intento: No adivinó la palabra\n";
     }
}
function mostrarResumen ($datos){
    echo("************************************\n");
    echo("Jugador: $datos[jugador]\n");
    echo("Partidas: $datos[cantPartidas]\n");
    echo("Puntaje Total: $datos[totalPuntaje]\n");
    echo("Porcentaje de victorias: $datos[porcentajeVictorias]\n");
    echo("Adivinadas: $datos[victorias]\n");
    echo("      Intento 1: $datos[int1]\n      Intento 2: $datos[int2]\n      Intento 3: $datos[int3]\n      Intento 4: $datos[int4]\n      Intento 5: $datos[int5]\n      Intento 6: $datos[int6]\n");
    echo("************************************\n");
}
function mostrarOrdenado ($partidasGuardadas){
    uasort($partidasGuardadas, 'compararPartidas');

            echo "Listado de partidas ordenadas por jugador y por palabra:\n";
            print_r($partidasGuardadas);

}

