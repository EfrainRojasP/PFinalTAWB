<?php 
include "../conexion.php";
include "../Clases/Actividad.php";
include "../Clases/Edificio.php";
include "../Clases/Nodo.php";
include "../Clases/Espacio.php";
include "../Clases/Lectura.php";
include "../DAO/ActividadDAO.php";
include "../DAO/EdificioDAO.php";
include "../DAO/NodoDAO.php";
include "../DAO/EspacioDAO.php";
include "../DAO/LecturaDAO.php";

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
//$nodoDAO = new NodoDAO($conn);
//$nodoDAO->insertarNodo($nodo);

//$nodo = $nodoDAO->buscarNodo(2);
//echo $nodo->toString();

/*
$arrNodos = $nodoDAO->consultarNodos();
foreach ($arrNodos as $item) {
    echo $item->toString();
}
*/

//$espDAO = new EspacioDAO($conn);
//$esp = $espDAO->buscarEspacio(1);
//echo json_encode($esp->espacioJSON());
/*
//$f = $arrNods->nodoJSON();
//echo json_encode($arrNods->nodoJSON());
echo "\n";
$arrd = array("m" => 2, "d" =>2);
$arr = array("uno" => 2, "Dos" => $arrd);
//array_push($arr, $arrd);
echo json_encode($arr);
*/

$s = "2022-9-15 21:45:47";
$s = date("Y-m-d h:i:s");

//echo $s;



$ed = new Edificio(1, "");
$esp = new Espacio(1,0, $ed, array(new Nodo(0, 0)));
$act = new Actividad(1, "");
$lect = new Lectura(0, 23, 23, 4.5, "2022-9-15 21:48:47", $esp, $act, 5);
$lectDAO = new LecturaDAO($conn);
//$lectDAO->insertarActividadHasEsp($lect);
//$idUltimo = $lectDAO->idUltimaActividadHasEsp($lect);
//echo $idUltimo;

//$lect->setIdAHEHN($idUltimo);

$lectDAO->insertarLectura($lect);

?>