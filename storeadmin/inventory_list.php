<?php 
// This file is www.developphp.com curriculum material
// Written by Adam Khoury January 01, 2011
// http://www.youtube.com/view_play_list?p=442E340A42191003
session_start();
if (!isset($_SESSION["manager"])) {
    header("location: admin_login.php"); 
    exit();
}
// Be sure to check that this manager SESSION value is in fact in the database
$managerID = preg_replace('#[^0-9]#i', '', $_SESSION["id"]); // filter everything but numbers and letters
$manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); // filter everything but numbers and letters
$password = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["password"]); // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
include "../storescripts/connect_to_mysql.php"; 
$sql = mysqli_query($conn,"SELECT * FROM admin WHERE id='$managerID' AND nombreUsuario='$manager' AND contrasena='$password' LIMIT 1"); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo "Your login session data is not on record in the database.";
     exit();
}
?>
<?php 
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php 
// Delete Item Question to Admin, and Delete Product if they choose
if (isset($_GET['deleteid'])) {
	echo 'Esta seguro de eliminar el producto: ' . $_GET['deleteid'] . '? <a href="inventory_list.php?yesdelete=' . $_GET['deleteid'] . '">SI</a> | <a href="inventory_list.php">NO</a>';
	exit();
}
if (isset($_GET['yesdelete'])) {
	// remove item from system and delete its picture
	// delete from database
	$id_to_delete = $_GET['yesdelete'];
	$sql = mysqli_query($conn,"DELETE FROM producto WHERE id='$id_to_delete' LIMIT 1") or die (mysqli_error());
	// unlink the image from server
	// Remove The Pic -------------------------------------------
    $pictodelete = ("../inventory_images/$id_to_delete.jpg");
    if (file_exists($pictodelete)) {
       		    unlink($pictodelete);
    }
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 
// Parse the form data and add inventory item to the system
if (isset($_POST['product_name'])) {
	
    $product_name = $_POST['product_name'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$subcategory = $_POST['subcategory'];
	$details =$_POST['details'];
	// See if that product name is an identical match to another product in the system
	$sql = mysqli_query($conn,"SELECT id FROM producto WHERE producto_nombre='$product_name' LIMIT 1");
	$productMatch = mysqli_num_rows($sql); // count the output amount
    if ($productMatch > 0) {
		echo 'Lo siento "nombre del producto" duplicadoen el sitema, <a href="inventory_list.php">click Aqui</a>';
		exit();
	}
	// Add this product into the database now
	$sql = mysqli_query($conn,"INSERT INTO producto (producto_nombre, precio, detalles, categoria, sub_categoria, fecha) 
        VALUES('$product_name','$price','$details','$category','$subcategory',now())") or die (mysql_error());
    
    
    
    $sql = "SELECT id FROM producto WHERE producto_nombre='$product_name' LIMIT 1 ;";


$result = $conn->query($sql);


 if($result->num_rows > 0) {
     $row= $result->fetch_assoc();
     
    $pid  =$row['id'];
 
 }

        // Place image in the folder 
	$newname = "$pid.jpg";
	move_uploaded_file( $_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
	header("location: inventory_list.php"); 
    exit();
}
?>
<?php 






// This block grabs the whole list for viewing
$product_list = "";
$sql = mysqli_query($conn,"SELECT * FROM producto ORDER BY fecha DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
	while($row = mysqli_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["producto_nombre"];
			 $price = $row["precio"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["fecha"]));
			 $product_list .= "Producto ID: $id - <strong>$product_name</strong> - $$price - <em>fecha- $date_added</em> &nbsp; &nbsp; &nbsp; <a href='inventory_edit.php?pid=$id'>Editar</a> &bull; <a href='inventory_list.php?deleteid=$id'>Eliminar</a><br />";
    }
} else {
	$product_list = "You have no products listed in your store yet";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lista Inventario</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">
  <?php include_once("../template_header.php");?>
  <div id="pageContent"><br />
    <div align="right" style="margin-right:32px;"><a href="inventory_list.php#inventoryForm">+ Agregar nuevo Producto</a></div>
<div align="left" style="margin-left:24px;">
    
      <h2>Lista Inventario</h2>
      <?php echo $product_list; ?>
    </div>
    <hr />
    <a name="inventoryForm" id="inventoryForm"></a>
    <h3>
    &darr; Agregar nuevo Producto &darr;
    </h3>
    <form action="inventory_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right">Nombre Producto</td>
        <td width="80%"><label>
          <input name="product_name" type="text" id="product_name" size="64" />
        </label>(valor unico)</td>
      </tr>
      <tr>
        <td align="right">Precio Producto</td>
        <td><label>
          $
          <input name="price" type="text" id="price" size="12" />
        </label></td>
      </tr>
      <tr>
        <td align="right">Categoria</td>
        <td><label>
          <select name="category" id="category">
          <option value="ropa">Ropa</option>
         <option value="implementos">Accesorios</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="right">Sub Categoria</td>
        <td><select name="subcategory" id="subcategory">
        <option value=""></option>
          <option value="short">Short</option>
          <option value="terno">Terno Deportivo</option>
          <option value="camisetas">Camisetas</option>
         <option value="bucal">Zapatos</option>
               <option value="balon">Polines</option>
            
          </select></td>
      </tr>
      <tr>
        <td align="right">Detalle del  Producto</td>
        <td><label>
          <textarea name="details" id="details" cols="64" rows="5"></textarea>
        </label></td>
      </tr>
      <tr>
        <td align="right">Imagen del Producto</td>
        <td><label>
          <input type="file" name="fileField" id="fileField" />
        </label></td>
      </tr>      
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Agregar Producto" />
        </label></td>
      </tr>
    </table>
    </form>
    <br />
  <br />
  </div>
  <?php include_once("../template_footer.php");?>
</div>
</body>
</html>