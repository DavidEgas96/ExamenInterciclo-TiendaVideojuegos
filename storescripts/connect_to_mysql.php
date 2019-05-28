<?php
$db_servidor="localhost";
$db_usuario="fernando";
$db_clave="1234";
$db_base="tienda";

$conn=mysqli_connect("$db_servidor","$db_usuario","$db_clave")or die("No se pudo conectar con la base de datos");
mysqli_select_db($conn,"$db_base")or die("no base de datos");

?>