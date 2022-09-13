<?php
include "../conexion.php";
include "../Clases/Actividad.php";
include "../Clases/Nodo.php";
include "../DAO/ActividadDAO.php";
include "../DAO/NodoDAO.php";


$data = file_get_contents("php://input");
$actividad = json_decode($data);
$nombreActividad = $actividad->nombreActividad;

$act = new Actividad(0, $nombreActividad);
$actDAo = new ActividadDAO($conn);

$actDAo->insetarActividad($act);

//$mensaje = array

echo "Se inserto la activodad $nombreActividad";

?>
