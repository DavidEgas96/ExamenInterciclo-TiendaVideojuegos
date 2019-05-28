<?php
  include "storescripts/connect_to_mysql.php"; 
    $id = $_GET['id'];
    //echo "hhh".$id;
        $sql = "Delete from carrito where id=$id";

    
        echo "<script type='text/javascript'> var opcion = confirm('Esta seguro de eliminar'); if(opcion==true){}</script>";
        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('fila Eliminada'); window.location.href='listar_carrito.php';</script>";
        } else {
           echo "<script type='text/javascript'>alert('Categoria no puede ser eliminda ya que existentes productos de esta categoria'); window.location.href='listarCategoria.php';</script>";
            echo "hhh".$id;
        }    
?>