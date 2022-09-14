<?php 
include "../conexion.php";
include "../Clases/Edificio.php";
include "../DAO/EdificioDAO.php";

$data = file_get_contents("php://input");
$edificio = json_decode($data);
$nombreEd = $edificio->nombreEdificio;

$ed = new Edificio(0, $nombreEd);
$edDAO = new EdificioDAO($conn);
$edDAO->insetarEdificio($ed);

echo "Se inserto el edificio $nombreEd";

?>