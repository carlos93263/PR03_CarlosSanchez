<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ejemplo de formularios con datos en BD</title>
	</head>
	<body>
		<?php
			//realizamos la conexión con mysql
			$con = mysqli_connect('mysql.hostinger.es','u467566146_admin','1234567890','u467566146_intra');
			$sql = "UPDATE users SET nomUser='$_REQUEST[nomUser]', mail='$_REQUEST[mail]', telf='$_REQUEST[telf]', password='$_REQUEST[newpassword]', privilegios='$_REQUEST[privi]' WHERE idUser='$_REQUEST[id]'";

			//echo $sql;

			//lanzamos la sentencia sql
			$datos = mysqli_query($con, $sql);
			header("location: paginausuario_mod.php")
		?>
	</body>
</html>