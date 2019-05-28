<?php 
include "storescripts/connect_to_mysql.php"; 
$id=$_POST['pid'];
$sql = mysqli_query($conn,"SELECT * FROM producto WHERE id='$id' ");
$productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
		// get all the product details
		while($row = mysqli_fetch_array($sql)){ 
			 $product_name = $row["producto_nombre"];
            
			 $price = $row["precio"];
			 $details = $row["detalles"];
			 $category = $row["categoria"];
			 $subcategory = $row["sub_categoria"];
			 $date_added = strftime("%b %d, %Y", strtotime($row["fecha"]));
         }
		 $cantidad='1';
	} else {
		echo "That item does not exist.";
	    exit();
	}

$sql2 = "INSERT INTO carrito (producto,descripcion,precio,cantidad,total) VALUES ($id,'$product_name','$price','$cantidad','$price')";

if($conn->query($sql2)===TRUE){
	
 header("location: index.php"); 

}else{
echo "error: ".$sql2. $conn->error;
}
?>