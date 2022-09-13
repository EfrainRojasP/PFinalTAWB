<?php 
include "../conexion.php";
include "../Clases/Actividad.php";
include "../Clases/Edificio.php";
include "../Clases/Nodo.php";
include "../DAO/ActividadDAO.php";
include "../DAO/EdificioDAO.php";
include "../DAO/NodoDAO.php";

/*
//$act = new Actividad(0, "Preparacion de clase");
$accDAO = new ActividadDAO($conn);
//$accDAO->insetarActividad($act);
//$act = $accDAO->buscarActividad(1);
$act = $accDAO->consultarActividades();
foreach ($act as $item) {
    echo $item->toString();
}
*/

/*
//$ed = new Edificio(0, "LUZ");
$edDAO = new EdificioDAO($conn);
//$edDAO->insetarEdificio($ed);
//$ed = $edDAO->buscarEdificio(3);
//echo $ed->toString();
$ed = $edDAO->consultarEdificios();
foreach ($ed as $item) {
    echo $item->toString();
}
*/

//$accDAO = new ActividadDAO($conn);
//$act = $accDAO->buscarActividad(1);
//$nodo = new Nodo(0, 3.56, $act);
$nodoDAO = new NodoDAO($conn);
//$nodoDAO->insertarNodo($nodo);

//$nodo = $nodoDAO->buscarNodo(2);
//echo $nodo->toString();

$arrNodos = $nodoDAO->consultarNodos();
foreach ($arrNodos as $item) {
    echo $item->toString();
}


?>