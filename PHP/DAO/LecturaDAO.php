<?php 
class LecturaDAO{
    public $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function __destruct()
    {
    }

    public function insertarLectura($lectura): void
    {
        $condLuz = $lectura->getCondicionLuz();
        $humedad = $lectura->getHumedad();
        $temp = $lectura->getTemp();
        $idAHEHN = $lectura->getIdAHEHN();
        $stm = $this->conexion->prepare("INSERT INTO lecturaNodo(codicionLuz, humedad, temperatura, Actividad_has_Espacio_has_Nodo_idAHEHN) VALUES (?,?,?,?)");
        $stm->bind_param("dddi", $condLuz, $humedad, $temp, $idAHEHN);
        $stm->execute();
        $stm->close();
    }

    public function insertarActividadHasEsp($lectura): void
    {
        $idActividad = $lectura->getActividad()->getIdActividad();
        $idEHN = $lectura->getEspacio()->getIdEspacio();
        $fecha = $lectura->getfechaLectura();
        //echo $fecha;
        //$fecha = date("Y-m-d h:i:s");
        $stm = $this->conexion->prepare("INSERT INTO actividad_has_espacio_has_nodo(Actividad_idActividad,  Espacio_has_Nodo_idEHN, fechaLectura) VALUES (?,?,?)");
        $stm->bind_param("iis", $idActividad, $idEHN, $fecha);
        $stm->execute();
        $stm->close();
    }

    public function idUltimaActividadHasEsp($lectura): int
    {
        $idActividad = $lectura->getActividad()->getIdActividad();
        $idEHN = $lectura->getEspacio()->getIdEspacio();
        $fecha = $lectura->getfechaLectura();
        $sql = "SELECT * FROM actividad_has_espacio_has_nodo WHERE fechaLectura = '$fecha' AND Actividad_idActividad = $idActividad AND Espacio_has_Nodo_idEHN = $idEHN";
        $result = $this->conexion->query($sql);
        $row = $result->fetch_assoc();
        $idAHEHN = $row["idAHEHN"];
        return $idAHEHN;
    }

}
?>