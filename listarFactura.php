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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Facturar</title>
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
</head>
<body> 
	<!-- header modal -->
	<div class="modal fade" id="myModal88" tabindex="-1" role="dialog" aria-labelledby="myModal88"
		aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;</button>
					<h4 class="modal-title" id="myModalLabel">No Esperes Mas, Ingresa Ya!</h4>
				</div>
				<div class="modal-body modal-body-sub">
					<div class="row">
						<div class="col-md-8 modal_body_left modal_body_left1" style="border-right: 1px dotted #C2C2C2;padding-right:3em;">
							<div class="sap_tabs">	
								<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
									<ul>
										<li class="resp-tab-item" aria-controls="tab_item-0"><span>Ingresar</span></li>
										<li class="resp-tab-item" aria-controls="tab_item-1"><span>Crear</span></li>
									</ul>		
									<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
										<div class="facts">
											<div class="register">
												<form action="verificar.php" method="post">			
													<input name="usuario" placeholder="Usuario" type="text" required>						
													<input name="contrasenia" placeholder="Contraseña" type="password" required>										
													<div class="sign-up">
														<input type="submit" value="Sign in"/>
													</div>
												</form>
											</div>
										</div> 
									</div>	 
									<div class="tab-2 resp-tab-content" aria-labelledby="tab_item-1">
										<div class="facts">
											<div class="register">
												<form action="insertarCliente.php" method="post">			
                                                    <input placeholder="Genero" name="genero" type="text" required>
                                                    <input placeholder="Nombre" name="nombre" type="text" required>
                                                    <input placeholder="Apellido" name="apellido" type="text" required>
                                                    <input placeholder="Telefono" name="telefono" type="text" required>
                                                    <input placeholder="Fecha Nacimiento" name="fecha_nacimiento" type="text" required>
                                                    <input placeholder="Cedula" name="cedula" type="text" required>
                                                    <input placeholder="Nombre Usuario" name="name_usuario" type="text" required>
                                                    <input placeholder="Email Address" name="correo" type="email" required>
													<input placeholder="Calle secundaria" name="calleSecundaria" type="text" required>
                                                    <input placeholder="Calle pricipal" name="callePrimaria" type="text" required>
                                                    <input placeholder="Numero " name="numero" type="text" required>
                                                    <input placeholder="Password" name="Password" type="password" required>	
													<input placeholder="Confirm Password" name="Password" type="password" required>
                                                    
													<div class="sign-up">
														<input type="submit" name="agg" value="Create Account"/>
													</div>
												</form>
											</div>
										</div>
									</div> 			        					            	      
								</div>	
							</div>
							<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
							<script type="text/javascript">
								$(document).ready(function () {
									$('#horizontalTab').easyResponsiveTabs({
										type: 'default', //Types: default, vertical, accordion           
										width: 'auto', //auto or any width like 600px
										fit: true   // 100% fit in a container
									});
								});
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- header modal -->
	<!-- header -->
	
    <div class="header" id="home1">
		<div class="container">
			<div class="">
				<?php
                echo "<a><h3>Hola !</h3></a>"."&nbsp"."&nbsp"."&nbsp<br>";
                
                ?>
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo "&nbsp"."&nbsp"."&nbsp"."&nbsp"."&nbsp".$_SESSION['usuario']."   ".$_SESSION["apellido"]?>
			</div>
			<div class="w3l_logo">
				<h1><a href="index.php">WVentas<span>Tu tienda. Tu lugar.</span></a></h1>
			</div>
			<div class="search">
				<input class="search_box" type="checkbox" id="search_box">
				<label class="icon-search" for="search_box"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></label>
				<div class="search_form">
					<form action="#" method="post">
						<input type="text" name="Search" placeholder="Search...">
						<input type="submit" value="Send">
					</form>
				</div>
			</div>
			<div class="cart cart box_1"> 
				<form action="#" method="post" class="last"> 
					<input type="hidden" name="cmd" value="_cart" />
					<input type="hidden" name="display" value="1" />
					<button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
				</form>   
			</div>  
		</div>
	</div>
	<!-- //header -->
	<!-- navigation -->
	<div class="navigation">
		<div class="container">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header nav_2">
					<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div> 
					<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
					<ul class="nav navbar-nav">
						<li><a href="index.php" class="act">Inicio</a></li>	
						<!-- Mega Menu -->
						<li class="w3pages">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tienda <span class="caret"></span></a>
							<ul class="dropdown-menu">
								            <li><a href="listarCategoria.php">Listar Categoria</a></li>
                                            <li><a href="listarProducto.php">Listar Producto</a></li>
									        <li><a href="crearProducto.php">Crear Producto</a></li>
                                            <li><a href="crearCategoria.php">Crear Categoria</a></li>
							</ul>
						</li>
                        <li class="w3pages">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gestion de personal <span class="caret"></span></a>
							<ul class="dropdown-menu">
								            <li><a href="crearAdministrador.php">Nuevo Administrador</a></li>
                                            <li><a href="listarAdministrador.php">Listar Administradores</a></li>
                                            <li><a href="repartidor.php">Gestion de repartidores</a></li>
							</ul>
						</li>
                        <li class="w3pages">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuarios <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="listarUsuarios.php">Lista de Usuarios</a></li>
							</ul>
						</li>
						<li><a href="about.html">Nosotros</a></li> 
						<li class="w3pages"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perfil <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="modificarAdministrador.php">Modificar cuenta</a></li>
								<li><a href="eliminarAdministrador.php">Eliminar cuenta</a></li>
                                <li><a href="http://127.0.0.1/WVENTAS/cerrarSesionUsuario.php">Cerrar sesion</a></li>
							</ul>
						</li>  
					</ul>
				</div>
			</nav>
		</div>
	</div>
    
	<div class="breadcrumb_dress">
		<div class="container">
			<ul>
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a> <i>/</i></li>
				<li>Products</li>
			</ul>
		</div>
	</div>
    
	<div class="mobiles">
		<div class="container">
			<div class="w3ls_mobiles_grids">
				<div class="col-md-8 w3ls_mobiles_grid_right">
					<div class="clearfix"> </div>
					<div class="w3ls_mobiles_grid_right_grid3">
                    <form  method="post" >
			<br>
			<table >
				<tr>
					<th colspan="2">Cedula</th>
					<th colspan="2">Nombre</th>
                    <th colspan="2">Apellido</th>
                    <th colspan="2">Telefono</th>
                    <th colspan="2">Calle principal</th>
                    <th colspan="2">Calle secundaria</th>
                    <th colspan="2">Numero de casa</th>
                    <th colspan="2">Fecha</th>
                    <th colspan="2">Sub total</th>
                    <th colspan="2">Iva</th>
                    <th colspan="2">Total</th>
                
                </tr>
                <?php
                $id=$_SESSION['id'];
				$sql = mysqli_query($con, "SELECT * FROM usuario,persona,factura_cabecera,compra WHERE persona.id_p=usuario.persona and factura_cabecera.id=compra.factura_cabecera and factura_cabecera.usuario=usuario.id and usuario.id=$id ");
				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					while($row = mysqli_fetch_assoc($sql)){
						$idr=$row['id_p'];
                        echo '
						<tr>
				            <td colspan="2">'.$row['cedula'].'</td>
							<td colspan="2">'.$row['nombre'].'</td>
                            <td colspan="2">'.$row['apellido'].'</td>
                            <td colspan="2">'.$row['telefono'].'</td>
                            <td colspan="2">'.$row['calle_principal'].'</td>
                            <td colspan="2">'.$row['calle_secundaria'].'</td>
                            <td colspan="2">'.$row['numero'].'</td>
                            <td colspan="2">'.$row['fecha'].'</td>
                            <td colspan="2">'.$row['subtotal'].'</td>
                            <td colspan="2">'.$row['iva'].'</td>
                            <td colspan="2">'.$row['total'].'</td>';
                    }
				}
				?>
			</table>
                <br>              
	</form>    
  						<div class="col-md-4 agileinfo_new_products_grid agileinfo_new_products_grid_mobiles">
							<div class="agile_ecommerce_tab_left mobiles_grid">
								<div class="hs-wrapper hs-wrapper2">
								</div>
								<h5><a href="single.html"><?php echo $row['descripcion']; ?></a></h5> 
								<div class="simpleCart_shelfItem">
									<p><i class="item_price"><?php echo $row['precio']; ?></i></p>
									<form action="#" method="post">
										<input type="hidden" name="cmd" value="_cart" />
										<input type="hidden" name="add" value="1" /> 
										<input type="hidden" name="w3ls_item" value="<?php echo $row['descripcion']; ?>" /> 
										<input type="hidden" name="amount" value="<?php echo $row['precio']; ?>"/>   
										<button type="submit" class="w3ls-cart">Agregar al carrito</button>
									</form>
								</div> 
								
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="w3ls_mobiles_grid_right_grid3">
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>  

	<script type="text/javascript">
		$(window).load(function() {
			$("#flexiselDemo2").flexisel({
				visibleItems:4,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: { 
					portrait: { 
						changePoint:568,
						visibleItems: 1
					}, 
					landscape: { 
						changePoint:667,
						visibleItems:2
					},
					tablet: { 
						changePoint:768,
						visibleItems: 3
					}
				}
			});
			
		});
	</script>
	<script type="text/javascript" src="js/jquery.flexisel.js"></script>
	<!-- cart-js -->
	<script src="js/minicart.js"></script>
	<script>
        w3ls.render();

        w3ls.cart.on('w3sb_checkout', function (evt) {
        	var items, len, i;

        	if (this.subtotal() > 0) {
        		items = this.items();

        		for (i = 0, len = items.length; i < len; i++) { 
        		}
        	}
        });
    </script>  
	<!-- //cart-js --> 
</body>
</html>