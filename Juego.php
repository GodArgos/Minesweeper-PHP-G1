<?php

    
    require_once("./Tablero.php");

    class Juego{
        
        public $T;
        public $namePlayerA = array();
        public $Historial = array();

        public function __construct(){
            $this->T = new Tablero();
        }

        public function menu(){
            $activar = true;
            while($activar){
                echo "\n=================================\n";
                echo "     JUEGO BUSCA MINAS           \n";
                echo "=================================\n";
                echo "JUGAR.........................[1]\n";
                echo "SALIR.........................[2]\n";
                echo "=================================\n";
                echo "\nElige la opcion: ";
                $opcion = readline();
                echo "\n";
                switch ($opcion){
                    case 1:
                        $this->T = new Tablero();
                        $this->jugar();
                        break;
                    case 2:
                        echo "Gracias por jugar\n\n";
                        $activar = false;
                }
            }
        }



        public function jugar(){
            $casillaselegidas = array();
            $namePlayer = readline("Ingrese su nombre: ");
            while(in_array($namePlayer,$this->namePlayerA)==true){
                echo "Ese nombre ya ha sido elegido, por favor ingrese un nombre diferente\n";
                $namePlayer = readline("Ingrese su nombre: ");
            }
            
            echo "\n";
            $this->T->llenarTablero();
            $this->T->mostrarTablero();
            $aciertos = 0;
            $objetivo = $this->T->nroCasillasNoMinas();
            $HoraInicial = strtotime(date("G:i:s"));
            $salir = false;
            echo "\ncantidad de casilleros sin minas: ",$this->T->nroCasillasNoMinas();
        
            do{

                echo "\nElige un casillero ingresando sus coordenadas \n";
                echo "\nFila: "; $fila = readline();
                while($fila>6 or $fila<1){
                    echo "El rango de filas y columnas es de 1 a 6, por favor elija una fila en ese rango";
                    echo "\nFila: "; $fila = readline();
                }
                echo "Columna: "; $columna = readline();
                while($columna>6 or $columna<1){
                    echo "El rango de filas y columnas es de 1 a 6, por favor elija una fila en ese rango";
                    echo "\nColumna: "; $columna = readline();
                }
                echo "\n";
                $elegido = ($fila*10)+$columna;
                while(in_array($elegido,$casillaselegidas)==true){
                    echo "Esa casilla ya ha sido seleccionada, porfavor elija una diferente";
                    echo "\nFila: "; $fila = readline();
                    while($fila>6 or $fila<1){
                        echo "El rango de filas y columnas es de 1 a 6, por favor elija una fila en ese rango";
                        echo "\nFila: "; $fila = readline();
                    }
                    echo "Columna: "; $columna = readline();
                    while($columna>6 or $columna<1){
                        echo "El rango de filas y columnas es de 1 a 6, por favor elija una fila en ese rango";
                        echo "\nColumna: "; $columna = readline();
                    }
                    echo "\n";
                    $elegido = $fila*10+$columna;
                }

                $casillaselegidas[] = $elegido;

                if($this->T->voltearCasilla($fila-1,$columna-1)){
                    $this->T->mostrarTablero();
                    $aciertos ++;
                    echo "\nAciertos: ",$aciertos;
                    if($aciertos==$objetivo){
                        $HoraFinal = strtotime(date("G:i:s"));
                        $HoraResultante = $HoraFinal - $HoraInicial;
                        echo "\nFelicidades $namePlayer, ganaste el juego\n";
                        echo "Tu tiempo fue de $HoraResultante segundos\n";
                        $this->namePlayerA[] = $namePlayer;
                        $this->Historial[$namePlayer] = $HoraResultante;
                        asort($this->Historial);
                        array_splice($this->Historial,3);

                        echo "\n=================================\n";
                        echo "\tLos mejores tiempos";
                        echo "\n=================================\n";
                        
                        foreach($this->Historial as $key => $valou){
                            echo "Jugador: ",$key,"\t\tTiempo: ",$valou,"\n";
                        }
                        
                        $salir = true;
                    }
                }
                else{
                    echo "Ha perdido";
                    
                    $salir = true;
                }

            }while(!$salir);
            
        }

    }


?>
