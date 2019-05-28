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
<title>Facturar</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
	 <?php include_once("template_header.php");?>
        <div id="pageContent">
        <h1>Factura</h1>
        <hr>
            <table class="cabecera">
<?php 
	$mes = date("m");
    $dia = date("d");
    $anio = date("Y");
    $fecha= $anio.'-'.$mes.'-'.$dia;
?>
             <tr>
                  <td>
                    <label>Fecha </label>
                    <input type="text" id="fecha" value="<?php echo $fecha; ?>" disabled class="des">
                  </td>
                  <td>
                     <label> Usuario:</label>
                     <input type="text" id="usuario" value="<?php echo $_SESSION['manager']?>" disabled class="des">
                  </td>
                  </tr>
                
            </table>
            <h1> Detalle</h1>
      
<?php
    $sql = "Select * from carrito";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //session_start();
            
            //session_name($usuario);
             
            //while (valor = ""){
        echo "<table width='90%' border='1' cellspacing='0' cellspacing='6'><tr><td bgcolor='#C5DFFA'><strong>CANTIDAD</strong></td><td bgcolor='#C5DFFA'><strong>DESCRIPCION</strong></td><td bgcolor='#C5DFFA'><strong>SUBTOTAL</strong></td></tr>";
               // valor = "ll";
           // }
        while($row = $result->fetch_assoc()) {
            $id="".$row['id'];
            $producto=''.$row['producto'];
        echo "<tr><td>".$row['cantidad']. "</td><td>".$row['descripcion']. "</td><td>".$row['total']. "</td></tr>";
    }
    echo "</table>";
    //echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
    
        
} else {
    echo "0 resultados";
}

    //echo "<p>" . $cedula . "</p>";
?>
            
            <form action="guardarFactura.php" method="POST">
            <table id="totales">
<?php
                    
     $count= mysqli_query($conn, "SELECT SUM(total) as c FROM carrito")  or die(mysqli_error());
     if($count){
        while($row=mysqli_fetch_assoc($count)){
             $suma= $row['c'];
             $t = (0.12*$suma)+($suma);
        }     
     }
                        
?>
                
                <tr>
                                <td></td>
                                <td></td>
                                <td><label>Subtotal</label></td>
                                <td><input type="text" name="subt" disabled class="des" value="<?php echo $suma; ?>" id="subt"/></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><label>IVA</label></td>
                                <td><input type="text" disabled class="des" value="12" id="iva"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><label>Total</label></td>
                                <td><input type="text" name ="tot" disabled class="des" value="<?php echo $t; ?>" id="tot"></td>
                            </tr>         
            </table><br/>
                <input type="submit" value="Confirmar" class="botones" id="formu">
            </form><br/>
            
            
        </div>
         <?php include_once("template_footer.php");?>
    </div>              
</body>   
</html>