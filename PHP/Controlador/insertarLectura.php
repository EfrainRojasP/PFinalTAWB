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
$luz = $req->condLuz;
$hum = $req->hum;
$temp = $req->temp;
$idAHENH = $req->idAHENH;

$esp = new Espacio(0, 0, new Edificio(0, ""), array(new Nodo(0, 0)));
$act = new Actividad(0, "");

$lect = new Lectura(0, $luz, $hum, $temp, "", $esp, $act, $idAHENH);
$lectDAO = new LecturaDAO($conn);
$lectDAO->insertarLectura($lect);

echo "";

?>