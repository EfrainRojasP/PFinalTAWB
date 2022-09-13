<?php 
class EdificioDAO{
    public $conexion; 

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function __destruct()
    {
    }

    public function insetarEdificio($edi): void
    {
        $stm = $this->conexion->prepare("INSERT INTO Edificio(nombreEdificio) VALUES(?)");
        $nombre = $edi->getNombre();
        $stm->bind_param("s", $nombre);
        $stm->execute();
        $stm->close();
    }


    public function buscarEdificio($idEdi): Edificio
    {
        $sql = "SELECT * FROM Edificio WHERE idEdificio = $idEdi";
        $result = $this->conexion->query($sql);
		$row = $result->fetch_assoc();
        $edificio = new Edificio($row["idEdificio"], $row["nombreEdificio"]);
        $result->close();
        return $edificio;
    }

    public function consultarEdificios(): array
    {
        $edificios = array();
        $sql = "SELECT * FROM Edificio";
        $result = $this->conexion->query($sql);
        while ($row = $result->fetch_assoc()) {
            $edificio = new Edificio($row["idEdificio"], $row["nombreEdificio"]);
            array_push($edificios, $edificio);
        }
        $result->close();
        return $edificios;
    }


}
?>