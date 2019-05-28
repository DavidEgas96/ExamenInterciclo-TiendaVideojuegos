<?php 
session_start();
   include "storescripts/connect_to_mysql.php"; 
$dynamicList = "";
$sql = mysqli_query($conn,"SELECT * FROM producto ORDER BY fecha DESC");
$productCount = mysqli_num_rows($sql); // count the output amount
if ($productCount > 0) {
    
     $dynamicList .="<TABLE BORDER=1>  ";
	while($row = mysqli_fetch_array($sql)){ 
             $id = $row["id"];
			 $product_name = $row["producto_nombre"];
			 $price = $row["precio"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["fecha"]));
			 $dynamicList .= " <TR> <TD>
             
             <a title='Los Tejos' href='http://localhost/MyOnlineStore/product.php?id=$id'>
             <IMG SRC='inventory_images/$id.jpg' width='100px' ></a>
             </TD>
             <TD>producto: $id - $product_name - $$price -  $date_added </TD>  </TR>";
    }
     $dynamicList .="</TABLE> ";
    
    
  
    
} else {
	$dynamicList = "no existe productos";
}





?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VATEX</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php");?>
  <div id="pageContent">
  <table width="100%" border="0" cellspacing="0" cellpadding="10">
  <tr>
            <td width="20%" valign="top">
                <a href='Inicio.php'>Iniciar Sesión:</a>
                <br>
                <br>
                <a href=' registro.php' >Registrese:</a>
                <br>
                <br>
                <a href=" http://localhost/MyOnlineStore/storeadmin/admin_login.php">Inventario:</a>
            </td>
    
      
              <td width="40%" valign="top">
                  <h3>Productos</h3>
                  
               
                     
                      
                       <?php echo $dynamicList; ?>
                      
                      
      </td>    
                      
 
      
      
             
              
  </tr>
</table>

  </div>
  <?php include_once("template_footer.php");?>
</div>
</body>
</html>