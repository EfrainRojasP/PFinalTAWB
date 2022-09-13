<?php 

include "../conexion.php";
include "../DAO/ActividadDAO.php";
include "../Clases/Actividad.php";

$actDAO = new ActividadDAO($conn);
$act = $actDAO->consultarActividades();

$arrAct = array();

foreach ($act as $item) {
    //echo $item->toString();
    array_push($arrAct, $item->actividadJSON());
}

echo json_encode($arrAct);

?>