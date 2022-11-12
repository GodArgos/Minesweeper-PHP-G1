<?php

    
    require_once("./Tablero.php");

    class Juego{
        
        public $T;

        public function __construct(){
            $this->T = new Tablero();
        }

        public function menu(){
            echo "\n=================================\n";
            echo "     JUEGO BUSCA MINAS           \n";
            echo "=================================\n";
            echo "JUGAR.........................[1]\n";
            echo "SALIR.........................[2]\n";
            echo "=================================\n";
            echo "Elige la opcion: ";
            $opcion = readline();
            switch ($opcion){
                case 1:
                    $this->jugar();
                    break;
                case 2:
                    echo "Gracias por jugar";
                    break;
            }
        }

        public function jugar(){
            $this->T->llenarTablero();
            $this->T->mostrarTablero();
            $columna = 0;
            $aciertos = 0;
            $objetivo = $this->T->nroCasillasNoMinas();
            $salir = false;
            echo "cantidad de casilleros sin minas: ",$this->T->nroCasillasNoMinas();
        
            do{

                echo "\nElige un casillero ingresando sus coordenadas ";
                echo "\nFila: "; $fila = readline();
                echo "Columna: "; $columna = readline();
                if($this->T->voltearCasilla($fila,$columna)){
                    $this->T->mostrarTablero();
                    $aciertos ++;
                    echo "Aciertos: ",$aciertos;
                    if($aciertos==$objetivo){
                        echo "Felicidades, Ganaste el juego";
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
