<?php 
$server = "localhost";
$user=	  "root";
$password="21350821Dd"; 
$db= 	  "MonitoresEspaciosAcademicos";
$conn= new mysqli($server, $user, $password,$db);
if($conn->connect_error){
    die("Conexion fallida".$conn->connect_error );
}
?>