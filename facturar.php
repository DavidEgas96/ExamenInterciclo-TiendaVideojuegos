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
<?php 
$factSalida = "";
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$sql = mysqli_query($conn,"SELECT * FROM producto WHERE id='$id' LIMIT 1");
	$productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysqli_fetch_array($sql)){ 
			 $product_name = $row["producto_nombre"];
            
			 $price = $row["precio"];
			 $details = $row["detalles"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["fecha"]));
         }
		 
	} else {
		echo "That item does not exist.";
	    exit();
	}
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
       <div id="cabecera" style="margin:20px;">
         <table width="90%" border="0" cellspacing="0" cellpadding="6">
         <tr>
           <td width="41%"><p><img src="style/logo.png" width="251" height="88" alt="logo" /></p>
           <p>TIENDA ONLINE JUKU</p>
           <p>Fecha: </p></td>
           <td width="59%" align="left"> <div id="datosFact" align="right">
             <p>R.U.C : 1720746724</p>
             <p>FACTURA No : </p>
           </div> </td>
         </tr>
         <tr>
           <td><p>Cliente:</p>
           <p>Direccion</p></td>
           <td><p>Cedula:</p>
           <p>Telefono:</p></td>
           </tr>
       </table>
       </div>
         <div id="detalle" style="margin:20px;">
           <table width="90%" border="1" cellspacing="0" cellpadding="6">
         <tr>
           <td width="15%" bgcolor="#C5DFFA"><strong>CANTIDAD</strong></td>
           <td width="46%" bgcolor="#C5DFFA"><strong>DESCRIPCION</strong></td>
           <td width="20%" bgcolor="#C5DFFA"><strong>P.UNITARIO</strong></td>
           <td width="19%" bgcolor="#C5DFFA"><strong>TOTAL</strong></td>
         </tr>
       </table>
      
       </div>
       <div id="detalle" style="margin-left:400px; padding-left:60px;">
         <table width="70%" height="133" border="1" cellpadding="6" cellspacing="0" style="margin:40px;">
           <tr>
             <td width="54%" bgcolor="#C5DFFA" style="text-align: center"><strong>SUB-TOTAL</strong></td>
             <td width="46%" style="text-align: center">&nbsp;</td>
           </tr>
           <tr>
             <td bgcolor="#C5DFFA" style="text-align: center"><strong>IVA</strong></td>
             <td style="text-align: center">&nbsp;</td>
           </tr>
           <tr>
             <td bgcolor="#C5DFFA" style="text-align: center"><strong>TOTAL</strong></td>
             <td style="text-align: center">&nbsp;</td>
           </tr>
         </table>
         <form id="form1" name="form1" method="post" action="cart.php">
           <input type="submit" name="listaFact" id="listaFact" value="Venta" />
         </form>
         <p>&nbsp;</p>
       </div>
     </div>
     <?php include_once("template_footer.php");?>
</div>
</body>
</html>