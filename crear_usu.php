<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ejemplo de formularios con datos en BD</title>
	</head>
	<body>
		<?php
			//realizamos la conexión con mysql
			$con = mysqli_connect('localhost', 'root', '', 'bd_intranet');
			$sql = "INSERT INTO users (idUser, nomUser, mail, telf, password, privilegios, estat) VALUES (NULL, '$_REQUEST[nomUser]', '$_REQUEST[mail]', '$_REQUEST[telf]', '$_REQUEST[password]', '$_REQUEST[privi]', '1')";

			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);
			header("location: paginausuario_mod.php")
		?>
	</body>
</html>