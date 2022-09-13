<?php
	class Edificio{
		private $idEdificio;
		private $nombre;
		
		
		function __construct($idEdificio, $nombre){
			$this->idEdificio=$idEdificio;
			$this->nombre=$nombre;
		}
		
		
		function __destruct(){}
		

		function setIdEdificio($idEdificio){
			$this->idEdificio=$idEdificio;
		}
		
		function setNombre($nombre){
			$this->nombre=$nombre;
		}
	
		function getIdEdificio():int{
			return $this->idEdificio;
			
		}

		function getNombre():string{
			return $this->nombre;
			
		}


		public function edificioJSON(): array
		{
			return array("idEd" => $this->getIdEdificio(), "nombreEd" => $this->getNombre());
		}
		
		function toString():string{
			return "IdEdificio:".$this->getIdEdificio()." , Nombre:".$this->getNombre().". ";
		}
		
}

?>