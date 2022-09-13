<?php

class ActividadDAO
{
    public $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function __destruct()
    {
    }

    public function insetarActividad($act): void
    {
        $stm = $this->conexion->prepare("INSERT INTO Actividad(tipoActividad) VALUES(?)");
        $nombre = $act->getNombreActividad();
        $stm->bind_param("s", $nombre);
        $stm->execute();
        $stm->close();
    }


    public function buscarActividad($idActividad): Actividad
    {
        $sql = "SELECT * FROM Actividad WHERE idActividad = $idActividad";
        $result = $this->conexion->query($sql);
		$row = $result->fetch_assoc();
        $actividad = new Actividad($row["idActividad"], $row["tipoActividad"]);
        $result->close();
        return $actividad;
    }

    public function consultarActividades(): array
    {
        $actividades = array();
        $sql = "SELECT * FROM Actividad";
        $result = $this->conexion->query($sql);
        while ($row = $result->fetch_assoc()) {
            $actividad = new Actividad($row["idActividad"], $row["tipoActividad"]);
            array_push($actividades, $actividad);
        }
        $result->close();
        return $actividades;
    }

}
?>
