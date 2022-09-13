<?php 
class NodoDAO{
    public $conexion; 

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function __destruct()
    {
    }

    public function insertarNodo($nodo): void
    {
        $stm =  $this->conexion->prepare("INSERT INTO nodo(rangoNodo, Actividad_idActividad) VALUES (?, ?)");
        $rango = $nodo->getRango();
        $actividad = $nodo->getActividad()->getIdActividad();
        $stm->bind_param("ii", $rango, $actividad);
        $stm->execute();
        $stm->close();
    }


    public function buscarNodo($idNodo): Nodo
    {
        $sql = "SELECT * FROM nodo_actividad WHERE idNodo = $idNodo";
        $result = $this->conexion->query($sql);
        $row = $result->fetch_assoc();
        $actividad = new Actividad($row['idActividad'], $row['tipoActividad']);
        $nodo = new Nodo($row["idNodo"], $row["rangoNodo"], $actividad);
        $result->close();
        return $nodo;
    }

    public function consultarNodos(): array
    {
        $nodos = array();
        $sql = "SELECT * FROM nodo_actividad";
        $result = $this->conexion->query($sql);
        while ($row = $result->fetch_assoc()) {
			$actividad = new Actividad($row['idActividad'], $row['tipoActividad']);
			$nodo = new Nodo($row["idNodo"], $row["rangoNodo"], $actividad);
			array_push($nodos, $nodo);
		}
		$result->close();
        return $nodos; 
    }

}

?>