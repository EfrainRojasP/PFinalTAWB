<?php 
    class Nodo{
        private int $idNodo;
        private float $rango;

        public function __construct($idNodo, $rango) {
            $this->idNodo = $idNodo;
            $this->rango = $rango;
        }

        function __destruct(){}

        public function nodoJSON(): array
        {
            return array("idNodo" => $this->getIdNodo(), "rangoNodo" => $this->getRango());
        }

        /**
         * Get the value of idNodo
         */ 
        public function getIdNodo(): int
        {
                return $this->idNodo;
        }

        /**
         * Set the value of idNodo
         *
         * @return  self
         */ 
        public function setIdNodo($idNodo)
        {
                $this->idNodo = $idNodo;

                return $this;
        }

        /**
         * Get the value of rango
         */ 
        public function getRango(): float
        {
                return $this->rango;
        }

        /**
         * Set the value of rango
         *
         * @return  self
         */ 
        public function setRango($rango)
        {
                $this->rango = $rango;

                return $this;
        }

        public function toString(): string
        {
            return " IDNodo: ". $this->getIdNodo().", Rango: ". $this->getRango();
        }
    }
?>