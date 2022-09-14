<?php 

include "../conexion.php";
include "../Clases/Nodo.php";
include "../DAO/NodoDAO.php";


$data = file_get_contents("php://input");
$nodo = json_decode($data);
$rangoNodo = $nodo->rangoNodo;

$newNodo = new Nodo(0, $rangoNodo);
$nodoDAO = new NodoDAO($conn);
$nodoDAO->insertarNodo($newNodo);

echo "Se inserto el nodo";

?>