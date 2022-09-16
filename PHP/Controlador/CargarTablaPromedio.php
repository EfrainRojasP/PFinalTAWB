<?php 
include "../conexion.php";
include "../Clases/Actividad.php";
include "../Clases/Edificio.php";
include "../Clases/Nodo.php";
include "../Clases/Lectura.php";
include "../Clases/Espacio.php";
include "../DAO/LecturaDAO.php";

$data = file_get_contents("php://input");
$req = json_decode($data);
$idAHENH = $req->idAHENH;

$lectDAO = new LecturaDAO($conn);

//$idAHENH=30;

$lect = $lectDAO->tablaPromedio($idAHENH);
$arr = $lect->lecturaJSON();
unset($arr["idLectura"]);
unset($arr["espacio"]);
unset($arr["actividad"]);

echo json_encode($arr);

?>