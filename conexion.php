<?php 
mysqli_report(MYSQLI_REPORT_STRICT);
$host = 'localhost';
$user = 'washappadmin';
$password = 'PerritaSalvaje1$';
$db = 'dbpromocion21';
$conexion = mysqli_connect($host, $user, $password, $db);
if(!$conexion){
    die("No hay coneccion: ".mysqli_connect_error());
}
?>
