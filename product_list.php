<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
    <link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>

<body>
    
<div align="center" id="mainWrapper">
  <?php include_once("template_header.php");?>
  
    <div>
        <?php 
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        	$resultado = mysqli_query($conn,"SELECT *
							FROM candidatos ");
		if (!$resultado) {
			echo 'No se pudo ejecutar la consulta: ' . mysqli_error();
			exit;
	}
		
    
    
    
    
    
		echo "
        
       

          <body style='background-color:D9FFAD;'>
        
         <form name='prueba' action='eliminadoMultiple.php' method='POST'>
        
         
         
         <div align='right'>
         <a  href='destruir.php' >Cerrar sesión</a>;
        </div>
        
			<table border=1 width=100%>
				<tr>
                    <td><b>Cedul</b></td>
					<td><b>Nombres</b></td>
					<td><b>Apellidos</b></td>
					<td><b>medio   </b></td>
					
                    
				</tr>";
				while ($fila = mysqli_fetch_row($resultado)){
				echo "<tr>";
				
					echo "<td>" . $fila[0] . "</td>";
					echo "<td>" . $fila[1] . "</td>";
					echo "<td>" . $fila[2] . "</td>";
					
            echo "<td><input type='button' name='facebook' value='facebook' onclick= window.location='contabilizar.php?ce=$fila[0]&fb=1&tw=0&it=0'></td> "; 
            echo "<td><input type='button' name='twiter' value='twiter' onclick= window.location='contabilizar.php?ce=$fila[0]&tw=1'></td> "; 
         echo "<td><input type='button' name='instagram' value='instagram' onclick= window.location='contabilizar.php?ce=$fila[0]&it=1'></td> "; 
                    
				echo "</tr>";
				}
			echo "</table>";
		
    
    
  echo "</form> 
  
  </body>"  ;
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        ?>
        
        
        
    </div>    
    
    <?php include_once("template_footer.php");?>
</div>
</body>
</html>