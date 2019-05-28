<div id="pageHeader"><table width="100%" border="0" cellspacing="0" cellpadding="12">
  <tr>
    <td width="40%"><a href="http://localhost/MyOnlineStore/index.php"><img src="http://localhost/MyOnlineStore /style/logo1.png" alt="Logo" width="600" height="80" border="0" /></a></td>
      <td width="68%" align="right">
          
    <?php 
          $manager = preg_replace('#[^A-Za-z0-9]#i', '', $_SESSION["manager"]); 
        
          echo 'Usuario:'.$manager;
          
          ?> <br>      
              <a  href='http://localhost/MyOnlineStore/destruir.php' >Cerrar sesión</a>
          
    
   
      
      </td>

  </tr>
  <tr>
    <td colspan="2">
        <a href= "http://localhost/MyOnlineStore/listar_carrito.php">CARRITO</a> </td>
      
    </tr>
  </table>
</div>