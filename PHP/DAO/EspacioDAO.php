<?php
class EspacioDAO
{
    public $conexion;


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function __destruct()
    {
    }


    public function insetarEspacio($esp): void
    {
        $stm = $this->conexion->prepare("INSERT INTO espacio(numero, Edificio_idEdificio) VALUES (?,?,?)");
        $numeroEsp = $esp->getNumero();
        $edificioEsp =  $esp->getEdificio()->getIdEdificio();
        $stm->bind_param("i,i", $numeroEsp, $edificioEsp);
        $stm->execute();
        $stm->close();
    }

    public function insertarEspacioHasNodo($arrNodos): void
    {
        $idEspacio = $this->idUltimoEspacio();
        $stm = $this->conexion->prepare("INSERT INTO espacio_has_nodo(Espacio_idEspacio, Nodo_idNodo) VALUES (?,?)");
        foreach ($arrNodos as $nodo) {
            $idNodo = $nodo->getIdNodo();
            $stm->bind_param("ii", $idEspacio, $idNodo);
            $stm->execute();
        }
        $stm->close();
    }

    public function buscarEspacio($idEspacio): Espacio
    {
        $sql = "SELECT * FROM espacio_edificio WHERE idEspacio= $idEspacio";
        $result = $this->conexion->query($sql);
		$row = $result->fetch_assoc();
        $numeroEsp = $row["numeroEspacio"];
        $edificio = new Edificio($row["idEdificio"], $row["nombreEdificio"]);
        $nodos = $this->espacioNodos($idEspacio);
        $espacio = new Espacio($idEspacio, $numeroEsp, $edificio, $nodos);
        $result->close();
        return $espacio;
    }

    public function consultarEspacios(): array
    {
        $espacios = array();
        $sql = "SELECT * FROM espacio_edificio";
        $result = $this->conexion->query($sql);
        while($row = $result->fetch_assoc()){
            $edificio = new Edificio($row["idEdificio"], $row["nombreEdificio"]);
            $nodos = $this->espacioNodos($row["idEspacio"]);
            $espacio = new Espacio($row["idEspacio"], $row["numeroEspacio"], $edificio, $nodos);
            array_push($espacios, $espacio);
        }
        
        $result->close();
        return $espacios;
    }

    public function idUltimoEspacio(): int
    {
        $sql = "SELECT max(idEspacio) AS idEspacio FROM espacio";
        $result = $this->conexion->query($sql);
        $row = $result->fetch_assoc();
        $id = $row['idEspacio'];
        $result->close();
        return $id;
    }

    private function espacioNodos($idEspacio): array
    {
        $nodos = array();
        $sql = "SELECT * FROM espacio_nodo WHERE idEspacio= $idEspacio";
        $result = $this->conexion->query($sql);
        while($row = $result->fetch_assoc()){
            $nodo = new Nodo($row["idNodo"], $row["rangoNodo"]);
            array_push($nodos, $nodo);
        }
        $result->close();
        return $nodos;
    }

}
?>
