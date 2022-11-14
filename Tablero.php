<?php

    class Tablero{
        
        public $tablero = array();
        public $minas = array();
        public $elegidos = array();


        public function __construct(){

            $this -> tablero = array(
                range(1,6)
            );
            for($i=0;$i<5;$i++){
                $this->tablero[] = range(1,6);
            };
            
            $this -> minas = array(
                range(1,6)
            );
            for($i=0;$i<5;$i++){
                $this->minas[] = range(1,6);
            }
            
            $this -> elegidos = array(
                array(false,false,false,false,false,false)
            );
            for($i=0;$i<5;$i++){
                $this->elegidos[] = array(false,false,false,false,false,false);
            }
        }

        public function generarMinas(){  
            
            for($i=0;$i<count($this->minas);$i++){
                for($j=0;$j<count($this->minas[$i]);$j++){
                    $this->minas[$i][$j]=rand(1,6);
                    if($this->minas[$i][$j]%2 == 0){
                        
                        $this->minas[$i][$j] = 1;

                    }
                    else{
                        $this->minas[$i][$j] = 0;
                    }
                }
            }
        }

        public function nroCasillasNoMinas(){
            $contador = 0;
            for($i=0;$i<count($this->tablero);$i++){
                for($j=0;$j<count($this->tablero[$i]);$j++){
                    if($this->tablero[$i][$j]<>"M"){
                        $contador ++;
                    }
                }
            }
            return $contador;
        }

        public function limpiarMinas(){
            for($i=0;$i<count($this->minas);$i++){
                for($j=0;$j<count($this->minas[$i]);$j++){
                    $this->minas[$i][$j]=0;
                }
            }
        }

        public function llenarTablero(){
            $this -> generarMinas();
            
            for($i=0;$i<count($this->minas);$i++){
                for($j=0;$j<count($this->minas[$i]);$j++){
                    if($this->minas[$i][$j]==1){
                        $this->tablero[$i][$j] = "M";
                    }else{
                        if($i==0 or $i==5){
                            if($i==0){
                                if($j==0 or $j==5){
                                    if($j==0){
                                        $this->tablero[$i][$j]=($this->minas[$i][$j]+$this->minas[$i][$j+1]+
                                        $this->minas[$i+1][$j]+$this->minas[$i+1][$j+1]);
                                    }
                                    if($j==5){
                                        $this->tablero[$i][$j]=($this->minas[$i][$j-1]+$this->minas[$i][$j]+
                                        $this->minas[$i+1][$j-1]+$this->minas[$i+1][$j]);
                                    }
                                }
                                else{
                                    $this->tablero[$i][$j]=($this->minas[$i][$j-1]+$this->minas[$i][$j]+$this->minas[$i][$j+1]+
                                    $this->minas[$i+1][$j-1]+$this->minas[$i+1][$j]+$this->minas[$i+1][$j+1]);
                                }
                            }
                            if($i==5){
                                if($j==0 or $j==5){
                                    if($j==0){
                                        $this->tablero[$i][$j]=($this->minas[$i-1][$j]+$this->minas[$i-1][$j+1]+$this->minas[$i][$j]+
                                        $this->minas[$i][$j+1]);
                                    }
                                    if($j==5){
                                        $this->tablero[$i][$j]=($this->minas[$i-1][$j-1]+$this->minas[$i-1][$j]+$this->minas[$i][$j-1]+
                                        $this->minas[$i][$j]);
                                    }
                                }
                                else{
                                    $this->tablero[$i][$j]=($this->minas[$i-1][$j-1]+$this->minas[$i-1][$j]+$this->minas[$i-1][$j+1]+
                                    $this->minas[$i][$j-1]+$this->minas[$i][$j] + $this->minas[$i][$j+1]);
                                }
                            }
                        }
                        else{
                            if($j==0 or $j==5){
                                if($j==0){
                                    $this->tablero[$i][$j]=($this->minas[$i-1][$j]+$this->minas[$i-1][$j+1]+$this->minas[$i][$j]+
                                    $this->minas[$i][$j+1]+$this->minas[$i +1][$j]+$this->minas[$i+1][$j+1]);
                                }
                                if($j==5){
                                    $this->tablero[$i][$j]=($this->minas[$i-1][$j-1]+$this->minas[$i-1][$j]+$this->minas[$i][$j-1]+
                                    $this->minas[$i][$j]+$this->minas[$i +1][$j-1]+$this->minas[$i+1][$j]);
                                }
                            }
                            else{
                                $this->tablero[$i][$j]=($this->minas[$i-1][$j-1]+$this->minas[$i-1][$j]+
                                $this->minas[$i-1][$j+1]+$this->minas[$i][$j-1]+$this->minas[$i][$j]+$this->minas[$i][$j+1]+
                                $this->minas[$i+1][$j-1]+$this->minas[$i+1][$j]+$this->minas[$i+1][$j+1]);
                            }
                        }
                    }
                }
            }
        }

        public function mostrarTablero(){
            echo "   1   2   3   4   5   6\n";
            for($i=0;$i<count($this->minas);$i++){
                echo $i+1;
                for($j=0;$j<count($this->minas[$i]);$j++){
                    
                    if($this->elegidos[$i][$j]==true){
                        
                        if($j==5){
                            echo " [" ,$this->tablero[$i][$j], "]";
                        }
                        else{
                            echo " [" , $this->tablero[$i][$j], "]";
                        }
                    }
                    else{
                        if($j==5){
                            echo " [ ]";
                        }
                        else{
                            echo " [ ]";
                        }
                    }
                }
                echo "\n";
            }            
        }

        public function voltearCasilla($fila,$columna){
            $continuar = false;
            for($i=0;$i<count($this->minas);$i++){
                for($j=0;$j<count($this->minas[$i]);$j++){
                    if($i==$fila && $j==$columna){
                        if($this->tablero[$i][$j]=="M"){
                            $continuar = false;
                        }
                        else{
                            $this->elegidos[$i][$j]=true;
                            $continuar = true;
                        }
                    }
                }
            }
            return $continuar;    
        }
    }

    
?>