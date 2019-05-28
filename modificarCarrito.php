
<?php
    include "storescripts/connect_to_mysql.php";
    $id = $_GET["producto"];
    $cantidad = $_POST['cantidad'];
    $total= "Select * from producto where id='$id'";
    $result = $conn->query($total);
        if ($result->num_rows >= 0) {
        session_start();
            while($row = $result->fetch_assoc()) {
                $precio=''.$row['precio'];
                $subtotal=($cantidad)*($precio);
                
        
        $sql = "Update carrito set cantidad=$cantidad, total=$subtotal where producto='$id'";
        if ($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'>alert('Carrito Actualizado'); window.location.href='listar_carrito.php';</script>";
        } else{
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
            }}
?>