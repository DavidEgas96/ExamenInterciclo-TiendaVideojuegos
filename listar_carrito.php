<?php 
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
session_start(); // Start session first thing in script
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Connect to the MySQL database  
include "storescripts/connect_to_mysql.php"; 
?>
<?php 
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011

if (!isset($_SESSION["manager"])) {
    header("location: http://localhost/MyOnlineStore/storeadmin/admin_login.php"); 
    exit();
}
// Be sure to check that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  

$sql = mysqli_query($conn,"SELECT * FROM admin WHERE id='$managerID' AND nombreUsuario='$manager' AND contrasena='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "la session no esta en la base de datos";
     exit();
}
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carrito</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
<?php include_once("template_header.php");?>
<div id="pageContent">
<h2>Carrito</h2>
<?php

    //$usuario =  $_POST["usuario"];

    //$cedula = $_GET['cedula'];
    $sql = "Select * from carrito";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        
        echo "<table width='90%' border='1' cellspacing='0' cellpadding='6'><tr><td bgcolor='#C5DFFA'><strong>ID</strong></td><td bgcolor='#C5DFFA'><strong>PRODUCTO</strong></td><td bgcolor='#C5DFFA'><strong>DESCRIPCION</strong></td><td bgcolor='#C5DFFA'><strong>CANTIDAD</strong></td><td bgcolor='#C5DFFA'><strong>TOTAL</strong></td><td bgcolor='#C5DFFA'><strong>ELIMINAR</strong></td><td bgcolor='#C5DFFA'><strong>MODIFICAR</strong></td></tr>";
               // valor = "ll";
           // }
        while($row = $result->fetch_assoc()) {
            $id="".$row['id'];
            $producto=''.$row['producto'];
        echo "<form id='formulario' name='formulario' method='post' action='modificarCarrito.php?producto=$producto';>";
        echo "<tr><td>".$row['id']. "</td><td>".$row['producto']. "</td><td>".$row['descripcion']. "</td><td><input type='text' name='cantidad' value=".$row['cantidad']. "></td><td>".$row['total']. "</td><td><input type='button' onclick= window.location='eliminarCarrito.php?id=$id' value='eliminar' id=".$id."></td><td><input type='submit' value='modificar' id=".$producto."></tr>";
        echo "</form>";
    }
    echo "</table>";
    //echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    
    echo "<p align='center' ><a href=factura.php>Comprar</a></p>";
        
} else {
    echo "EL carrito esta vacio";
        echo "<p align='center' ><a href=index.php>Agregar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=#>Listar Factura</p>";
		
}

    //echo "<p>" . $cedula . "</p>";
?>
<?php include_once("template_footer.php");?>
</div>

</div>

</body>
</html>