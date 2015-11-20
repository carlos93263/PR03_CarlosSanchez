<?php
	session_start();
?>
<!DOCTYPE HTML>
<HTML>
	<head>
		<title></title>
		<meta charset='utf-8'>
   		<meta http-equiv="X-UA-Compatible" content="IE=edge">
   		<meta name="viewport" content="width=device-width, initial-scale=1">
   		<link rel="stylesheet" href="css/menu.css">
   		<link href="css/paginausuario.css" rel="stylesheet" type="text/css">
   		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   		<script src="js/script.js"></script>
   		<link rel="stylesheet" href="css/nav.css">
   		
		
	</head>
	
	<body>
	<?php
	if(!empty($_SESSION['usuario'])){		//Aqui introducimos lo que puede ver un usuario con una cuentra normal
		$privilegios=$_SESSION['usuario'];	//Guardamos la variable usuario en $privilegios para que no haya diferencias entre usuario y administrador en el resto del codigo
	}else if(!empty($_SESSION['admin'])){ 	//Aqui introducimos lo que vera el administrador
		$privilegios=$_SESSION['admin'];	//Guardamos la variable admin en $privilegios para que no haya diferencias entre usuario y administrador en el resto del codigo
	}	
	?>
		<div class="header">
			<nav id="menu_gral">
		  		<ul>
			    	<li><a href="#"><?php
			    		echo  $privilegios;
						?></a>
        		<ul><!-- Segundo nivel desplegable -->
         			<li><a href="logout.php">Logout</a></li>
        		</ul>
    				</li>
			</nav>
			<img src="images/logo_2.png">
		</div>
		<div class="header-cont"></div>
			<div id='cssmenu'>
				<ul>
		   			<li><a href='paginausuario_reservar.php'><span>Reservar</span></a></li>
		   			<li class="despues"><a href='paginausuario_historial.php'><span>Historial</span></a></li>
		   			<li class='active'><a href='#'><span>Modificar<span></a></li>
				</ul>
			</div>  
		<div class="contenido">
			<center>
				<?php
			$con = mysqli_connect('mysql.hostinger.es','u467566146_admin','1234567890','u467566146_intra');
			$sql = "SELECT * FROM users WHERE idUser=".$_REQUEST['id'];
			$datos = mysqli_query($con, $sql);
			if(mysqli_num_rows($datos)==1){
				echo "<form name='mod_usu' action='modificar.proc.php' method='get'>";
					while($valor=mysqli_fetch_array($datos)){
						echo "<input type='hidden' name='id' value=".$valor['idUser'].">";
						
						echo "Nombre de usuario:<br>";
						echo "<input type='text' name='nomUser' value=".$valor['nomUser']." onfocus = 'this.blur()'><br>";
						
						echo "Email:<br>";
						echo "<input type='text' name='mail' value=".$valor['mail']." onfocus = 'this.blur()'><br>";
						
						echo "Telefono:<br>";
						echo "<input type='text' name='telf' value=".$valor['telf']."><br>";
						
						echo "Contraseña antigua:<br>";
						echo "<input type='text' name='password' value=".$valor['password']." onfocus = 'this.blur()'><br>";
						
						echo "Nueva contraseña:<br>";
						echo "<input type='text' name='newpassword'><br>";
						
						echo "Privilegios:<br>";
						echo "<select name='privi'><option value='admin'>Administrador</option><option value='member'>Miembro</option></select><br><br>";
					}
					echo "<input type='submit'>";
				echo "</form><br>";
				echo "<br><a href=paginausuario_mod.php>Volver</a>";
			} else {
				echo "No hay usuarios que modificar";
				header("location:paginausuario_mod.php");
			}
			mysqli_close($con);
		?>

			</center>
		</div>
		<div class="footer"></div>
	</body>
	<footer></footer>
</HTML>