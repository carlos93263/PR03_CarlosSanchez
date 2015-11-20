<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ejemplo de formularios con datos en BD</title>
	</head>
	<body>
		<form name="crearusu" action="crear_usu.php" method='get'>
			Nombre de usuario:<br>
			<input type='text' name='nomUser'><br>
			
			Email:<br>
			<input type='email' name='mail'><br>
						
			Telefono:<br>
			<input type='text' name='telf'><br>
			
			Contraseña:<br>
			<input type='password' name='password'><br>
			
			Privilegios:<br>
			<select name='privi'>
				<option value='admin'>Administrador</option>
				<option value='member' selected>Miembro</option>
			</select><br><br>
					
			<input type='submit'>
		</form>
	</body>
</html>