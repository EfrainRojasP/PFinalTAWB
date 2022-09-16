<?php 
include "../conexion.php";
include "../Clases/Espacio.php";
include '../Clases/Edificio.php';
include "../Clases/Nodo.php";
include "../DAO/EspacioDAO.php";

$espDAO = new EspacioDAO($conn);
$arrEspHNodo = $espDAO->consultarEHN();
$arrJSON = array();
foreach ($arrEspHNodo as $esp) {
    array_push($arrJSON, $esp->espacioJSON());
}

echo json_encode($arrJSON);


?>