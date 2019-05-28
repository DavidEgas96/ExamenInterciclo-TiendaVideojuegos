
<?php 
include "storescripts/connect_to_mysql.php"; 

$cedula=$_POST["cedula"];
echo $cedula ."<br>";
$nombre=$_POST["nombre"];
echo $nombre."<br>" ;
$apellido=$_POST["apellido"];
    
echo $apellido."<br>" ;
$telefono=$_POST["telefono"];
echo $telefono."<br>" ;
$direccion=$_POST["direccion"];
$contrasena=$_POST["contrasena"];
echo $direccion ."<br>";
echo $contrasena ."<br>";





$sql = "INSERT INTO admin (nombreUsuario, contrasena,fecha)
VALUES ('$nombre', '$contrasena',now());";

if ($conn->multi_query($sql) === TRUE) {
     // echo "<script> alert ('candidato insertado') ;window.location='index.php'; </script>" ;    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}




$sql = "INSERT INTO clientes (cedula, nombre, apellido,telefono,direccion,contrasena)
VALUES ('$cedula', '$nombre','$apellido', '$telefono','$direccion','$contrasena');";

if ($conn->multi_query($sql) === TRUE) {
      echo "<script> alert ('usuario insertado') ;window.location='index.php'; </script>" ;    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}











?>