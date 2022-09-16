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
$idAct = $req->idActividad;
$idEHN = $req->idEHN;
$fecha = $req->fechaLectura;

$esp = new Espacio($idEHN, 0, new Edificio(0, ""), array(new Nodo(0, 0)));
$act = new Actividad($idAct, "");

$lect = new Lectura(0, 0, 0, 0, $fecha, $esp, $act, 0);
$lectDAO = new LecturaDAO($conn);

$lectDAO->insertarActividadHasEsp($lect);
$idUltimo = $lectDAO->idUltimaActividadHasEsp($lect);

echo $idUltimo;


?>