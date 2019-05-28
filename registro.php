<!DOCTYPE html>

<html lang="en">
  <head>
      
      
    <meta charset="utf-8">
 
    <title>Datos Personales </title>
    <link rel="stylesheet" type="text/css" href="style/style.css" media= "screen">
      
       <script language ="JavaScript" type="text/javascript" src="validacion.js"></script>
	
	
   
  </head>
        
        
  <body>
     <div align="center" id="mainWrapper">
  <?php include_once("template_header.php");?>
  <div id="pageContent">
      
      <h1>Datos Personales </h1>
    
<form id="formulario" name ="formulario" method="post" action="regis.php" > 
   
    <table>
    <TR>
        <TD>           
            <label>CEDULA</label>
        </TD>
        <TD>
            <input name = "cedula" id="cedula" type ="text" value="" placeholder="cedula" onblur="validarCedula();"  /> (*)
         
            
        </TD>
    </TR>
        <TR>
        <TD>           
            <label>NOMBRE</label>
        </TD>
        <TD>
           <input name = "nombre" id="nombre" type ="text" value="" placeholder="nombre"   onblur="validarnombre();"  /> (*) 
        </TD>
    </TR>
        <TR>
        <TD>           
            <label>APELLIDO</label>
        </TD>
        <TD>
            <input name = "apellido" id="apellido" type ="text" value="" placeholder="apellido "    onblur="validarApellido();" /> (*)
        </TD>
    </TR>
        <TR>
        <TD>           
            <label>DIRECCION</label>
        </TD>
        <TD>
           <input name = "direccion" id="telefono" type ="text" value="" placeholder="direccion"   /> (*)
        </TD>
    </TR>
        <TR>
        <TD>           
            <label>TELEFONO</label>
        </TD>
        <TD>
            <input name = "telefono" id="telefono" type ="text" value="" placeholder="telefono"  /> (*)
        </TD>
    </TR>
        <TR>
        <TD>           
            <label>CONTRASENA</label>
        </TD>
        <TD>
            <input name = "contrasena" id="contrasena" type ="text" value="" placeholder="contrasena"  /> (*)
        </TD>
    </TR>
        
    
    </table>
    
    


<br>
<input name = "enviar" id="enviar" type ="submit" value="enviar" onclick="return validarCamposObligatorios(this);" /> 


    
                 
                   


</form>
         </div>
       <?php include_once("template_footer.php");?>
      </div>
        
  </body>
        
</html>