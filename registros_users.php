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
				$con = mysqli_connect('localhost','root','','bd_intranet');
				$privilegios=$_SESSION['admin'];
		?>
				<div>
					<form name="formulario_users" action="paginausuario_mod.php" method="POST">
						<select name="tipo_user">
							<option value="todos" selected>Todos</option>
							<option value="admin">Administradores</option>
							<option value="member">Miembros</option>
						</select>
					</form>
					<input type="submit">

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
						</tr>
						<?php
						$sql = "SELECT * FROM users WHERE users.privilegios=$_REQUEST[tipo_user]";
						$datos=mysqli_query($con,$sql);
						$datos=mysqli_query($con,$sql);
				        while($valor=mysqli_fetch_array($datos)){
						    echo "<tr>";
						    echo "<td>".$valor['nomUser']."</td>";
						    echo "<td>".$valor['mail']."</td>";
						    echo "<td>".$valor['telf']."</td>";
						    echo "<td>".$valor['password']."</td>";
							echo "<td>".$valor['privilegios']."</td>";
						    echo "</tr>";
						}
						?>
					</table>
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