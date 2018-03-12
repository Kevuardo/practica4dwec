<?php

    class Vehiculo {
        private $marca;
        private $modelo;
        private $consumo;

        public function __construct($_marca, $_modelo, $_consumo){
            $this->marca = $_marca;
            $this->modelo = $_modelo;
            $this->consumo = $_consumo;
        }

        public function getMarca(){
            return $this->marca;
        }
        public function getModelo(){
            return $this->modelo;
        }
        public function getConsumo(){
            return $this->consumo;
        }
    }

?>