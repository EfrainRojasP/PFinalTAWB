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
        $stm =  $this->conexion->prepare("INSERT INTO nodo(rangoNodo) VALUES (?)");
        $rango = $nodo->getRango();
        $stm->bind_param("d", $rango);
        $stm->execute();
        $stm->close();
    }


    public function buscarNodo($idNodo): Nodo
    {
        $sql = "SELECT * FROM nodo WHERE idNodo = $idNodo";
        $result = $this->conexion->query($sql);
        $row = $result->fetch_assoc();
        $nodo = new Nodo($row["idNodo"], $row["rangoNodo"]);
        $result->close();
        return $nodo;
    }

    public function consultarNodos(): array
    {
        $nodos = array();
        $sql = "SELECT * FROM nodo";
        $result = $this->conexion->query($sql);
        while ($row = $result->fetch_assoc()) {
			$nodo = new Nodo($row["idNodo"], $row["rangoNodo"]);
			array_push($nodos, $nodo);
		}
		$result->close();
        return $nodos; 
    }

}

?>