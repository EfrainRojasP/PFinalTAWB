<?php 

include "../conexion.php";
include "../Clases/Actividad.php";
include "../Clases/Nodo.php";
include "../DAO/ActividadDAO.php";
include "../DAO/NodoDAO.php";


$data = file_get_contents("php://input");
$nodo = json_decode($data);
$rangoNodo = $nodo->rangoNodo;
$actividad = $nodo->activiadad;


$actDAo = new ActividadDAO($conn);
$act = $actDAo->buscarActividad($actividad);

$newNodo = new Nodo(0, $rangoNodo, $act);
$nodoDAO = new NodoDAO($conn);
$nodoDAO->insertarNodo($newNodo);

//$mensaje = array

echo "Se inserto el nodo";

?>