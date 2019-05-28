
<?php
session_start();
include "storescripts/connect_to_mysql.php";
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
    $mes = date("m");
    $dia = date("d");
    $anio = date("Y");
    $usuario = $_SESSION['id'];
    $fecha= $anio.'-'.$mes.'-'.$dia;
    $iva = 12.00;
    $tt=0.00;
    
    $count= mysqli_query($conn, "SELECT SUM(total) as c FROM carrito")  or die(mysqli_error());
                        if($count){
                            while($row=mysqli_fetch_assoc($count)){
                                $suma= $row['c'];
                                $t = (0.12*$suma)+($suma);
                            }
                            $tt=$t;
                         }

       $sql2 = "Insert into factura(cliente, fecha, sub_total, iva, total) values ($usuario, '$fecha', '$suma', '$iva', '$tt')";
        if ($conn->query($sql2) === TRUE) {
            //echo "creado exitosamente";
            //header('Location: http://localhost:8888/p/buscar.php');
            echo "<script type='text/javascript'>alert('Agregado'); </script>";
        } else {
            echo "Error: " . $sql2. "<br>" . $con->error;
        }
      
    $count= mysqli_query($conn, "SELECT MAX(id) as c FROM factura")  or die(mysqli_error());
                        if($count){
                            while($row=mysqli_fetch_assoc($count)){
                                $maximo= $row['c'];
                            }     
                         }


    $total= "Select * from carrito";
    $result = $conn->query($total);
        if ($result->num_rows >= 0) {
            while($row = $result->fetch_assoc()) {
                $producto=''.$row['producto'];
                $descripcion=''.$row['descripcion'];
                $cantidad=''.$row['cantidad'];
                $sss=''.$row['total'];
				$pr=''.$row['precio'];
                
        
        $sql4 = "Insert into factura_detalle(factura, producto, descripcion, cantidad, precio, sub_total) values ($maximo, $producto, '$descripcion', '$cantidad', '$pr', '$sss')";
        if ($conn->query($sql4) === TRUE){
            
            
            $sql5 = "delete from carrito;";
                if ($conn->query($sql5) === TRUE){
                } else{
                echo "Error: " . $sql5 . "<br>" . $con->error;
                }
    
 
       header("Location: index.php");
        } else{
        echo "Error: " . $sql4 . "<br>" . $con->error;
        }
            }}
?>
