<link rel="stylesheet" href="css/tablareservas.css">
<!DOCTYPE html>
<html>
	<head>
		<title>  </title>
		<meta charset="UTF-8">
		<!-- FUNCION DE JAVASCRIPT QUE SE ENCARGARA DE RECARGAR LA PAGINA CADA VEZ QUE MODIFIQUEMOS EL SELECT="tipo_recurso" -->
	</head>
	<body>
		<?php
			
			if(!empty($_SESSION['usuario'])){
				$privilegios=$_SESSION['usuario'];
				echo '<script language="javascript">
				alert("No reunes los permisos necesarios para acceder a este apartado. Consulta con algun administrador.");
				document.location=("paginausuario_reservar.php");
				</script>';
			}else if(!empty($_SESSION['admin'])){
				$con = mysqli_connect('mysql.hostinger.es','u467566146_admin','1234567890','u467566146_intra');
				$privilegios=$_SESSION['admin'];
		?>
				<div>
					<form name="formulario_users" action="paginausuario_mod.php" method="GET">
						<select name="tipo_user">
							<option value="todos" selected>Todos</option>
							<option value="admin">Administradores</option>
							<option value="member">Miembros</option>
						</select>
						<input type="submit"><br><br>
					</form>
					
				<!-- TODO LO REFERENTE A MOSTRAR CONSULTA. -->
				<div>
					<h3>USUARIOS</h3>
					<table class="mytable">
						<tr>
							<th>Nombre usuario:</th>
							<th>Mail:</th>
							<th>Telefono:</th>
							<th>Contraseña:</th>
							<th>Tipo de usuario:</th>
							<th>Estado:</th>
							<th>Modificar:</th>

						</tr>
						<?php
						if ((!isset($_REQUEST['tipo_user'])) OR ($_REQUEST['tipo_user']=='todos')){
							$sql = "SELECT * FROM users";
						}else{
							$sql = "SELECT * FROM users WHERE users.privilegios='$_REQUEST[tipo_user]'";
						}
						$datos=mysqli_query($con,$sql);
				        while($valor=mysqli_fetch_array($datos)){
						    echo "<tr>";
						    echo "<td>".$valor['nomUser']."</td>";
						    echo "<td>".$valor['mail']."</td>";
						    echo "<td>".$valor['telf']."</td>";
						    echo "<td>".$valor['password']."</td>";
							echo "<td>".$valor['privilegios']."</td>";
							if ($valor['estat']==0){
								echo "<td><a href=paginausuario_mod2.proc.php?id=".$valor['idUser'].">Habilitar</a></td>";
							}else{
								echo "<td><a href=paginausuario_mod2.proc.php?id=".$valor['idUser'].">Deshabilitar</a></td>";
							}
							echo "<td><a href=paginausuario_mod3.php?id=".$valor['idUser'].">Modificar</a></td>";
							
						    echo "</tr>";
						}
						?>
					</table><br><br>
					<a href=paginausuario_mod_crearusu.php> CREAR UN NUEVO USUARIO</a>
				</div>
			<?php		
			} else {
					echo '<script language="javascript">
					alert("No estas logueado en la web.");
					document.location=("index.html");
					</script>';
			}
			?>

	</body>
</html>