<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ejemplo de formularios con datos en BD</title>
	</head>
	<body>
		<?php
			$con = mysqli_connect('localhost','root','','bd_intranet');
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
				echo "</form>";
			} else {
				echo "No hay usuarios que modificar";
				header("location:paginausuario_mod.php");
			}
			mysqli_close($con);
		?>

			
	</body>
</html>