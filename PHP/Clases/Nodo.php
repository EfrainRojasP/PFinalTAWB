<?php 
    class Nodo{
        private int $idNodo;
        private float $rango;
        private Actividad $actividad;

        public function __construct($idNodo, $rango, $actividad) {
            $this->idNodo = $idNodo;
            $this->rango = $rango;
            $this->actividad = new Actividad($actividad->getIdActividad(), $actividad->getNombreActividad());
        }

        function __destruct(){}

        public function nodoJSON(): array
        {
            return array("idNodo" => $this->getIdNodo(), "rangoNodo" => $this->getRango(), "actividad" => $this->actividad->actividadJSON());
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

        /**
         * Get the value of actividad
         */ 
        public function getActividad()
        {
                return $this->actividad;
        }

        /**
         * Set the value of actividad
         *
         * @return  self
         */ 
        public function setActividad($actividad)
        {
                $this->actividad = $actividad;

                return $this;
        }

        public function toString(): string
        {
            return " IDNodo: ". $this->getIdNodo().", Rango: ". $this->getRango()." Actividad: " .$this->actividad->toString();
        }
    }
?>