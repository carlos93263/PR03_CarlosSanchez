<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ejemplo de formularios con datos en BD</title>
	</head>
	<body>
		<?php
			$con = mysqli_connect('mysql.hostinger.es','u467566146_admin','1234567890','u467566146_intra');
			$sql = "SELECT * FROM users WHERE idUser=".$_REQUEST['id'];
			$datos = mysqli_query($con, $sql);

			if(mysqli_num_rows($datos)==1){
				$prod=mysqli_fetch_array($datos);
				if($prod['estat']==1){
					$sql = "UPDATE users SET estat=0 WHERE idUser=$_REQUEST[id]";
					header("location:paginausuario_mod.php");
				} else {
					$sql = "UPDATE users SET estat=1 WHERE idUser=$_REQUEST[id]";
					header("location:paginausuario_mod.php");
				}
			$datos = mysqli_query($con, $sql);
			} else {
				echo "No hay usuarios que modificar";
			}
			mysqli_close($con);
		?>
	</body>
</html>