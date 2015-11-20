<link rel="stylesheet" href="css/tablareservas.css">
<!DOCTYPE html>
<html>
	<head>
		<title>  </title>
		<meta charset="UTF-8">
		<!-- FUNCION DE JAVASCRIPT QUE SE ENCARGARA DE RECARGAR LA PAGINA CADA VEZ QUE MODIFIQUEMOS EL SELECT="tipo_recurso" -->
		<script type="text/javascript">

		</script>
	</head>
	<body>
		<?php
			//COMPROVACION DE LAS SESSIONES DEL USUARIO.
			if(!empty($_SESSION['usuario'])) {	// Sesion de un usuario			
				$user=$_SESSION['idUser'];
			} elseif(!empty($_SESSION['admin'])) {		//sesion de un administrador
				$user=$_SESSION['idUser'];
			} else {
				?>
				<p>No estas logueado</p>
				<?php
			}
			//TODA LA EJECUCION DESPUES DE LA PRIMERA RECARGA DE LA PAGINA.
			if((isset($_SESSION['resRecurso'])) && (isset($_REQUEST['data_ini']))){
				$conn=mysqli_connect('localhost','root','','bd_intranet');
				$sql_compro="SELECT hours.*, registers.*, users.*, resources.*, estadoinfo.*, resourcestype.* FROM (((((resourcestype INNER JOIN resources ON resourcestype.idRType=resources.idRType) INNER JOIN estadoinfo ON resources.idEstado=estadoinfo.idEstado) INNER JOIN registers ON registers.idResource=resources.idResource) INNER JOIN users ON users.idUser=registers.idUser) INNER JOIN hours ON hours.idFranja=registers.idFranja) 
				WHERE registers.idResource='$_SESSION[resRecurso]' && registers.data_ini='$_REQUEST[data_ini]' && registers.data_fin='$_REQUEST[data_ini]' && registers.idFranja='$_REQUEST[franjahoraria]'";
				$datos=mysqli_query($conn,$sql_compro);
				$num_filas = mysqli_num_rows($datos);
				if ($num_filas!=0){
					unset($_SESSION['resRecurso']);
					echo'<script language="javascript">
						document.location=("paginausuario_reservar.php");
						alert("El articulo seleccionado no esta disponible a esa hora. Disculpa las molestias.");
				    </script>';
				}else{
					//Si es cero tiene que ejecutarse el INSERT
					$conn=mysqli_connect('localhost','root','','bd_intranet');
					$sql_intro="INSERT INTO registers (idRegister, data_ini, data_fin, idResource, idUser, idFranja) VALUES (NULL, '$_REQUEST[data_ini]', '$_REQUEST[data_ini]', '$_SESSION[resRecurso]', '$user', $_REQUEST[franjahoraria])";
					//"SELECT hours.*, registers.*, users.*, resources.*, estadoinfo.*, resourcestype.* FROM (((((resourcestype INNER JOIN resources ON resourcestype.idRType=resources.idRType) INNER JOIN estadoinfo ON resources.idEstado=estadoinfo.idEstado) INNER JOIN registers ON registers.idResource=resources.idResource) INNER JOIN users ON users.idUser=registers.idUser) INNER JOIN hours ON hours.idFranja=registers.idFranja) WHERE registers.idResource=$_SESSION[resRecurso] && registers.data_ini=$_REQUEST[data_ini] && registers.data_fin=$_REQUEST[data_ini] && registers.idFranja=$_REQUEST[franjahoraria]";
					$datos=mysqli_query($conn,$sql_intro);
					unset($_SESSION['resRecurso']);
					echo '<script language="javascript">
						document.location=("paginausuario_reservar.php");
						alert("Tu reserva se ha confirmado");
					  </script>';
				}
			}else{
		?>	
		<!-- TODO LO REFERENTE A LOS FORMULARIOS DE SELECCION DE DIA I HORA. -->
			<form name="confirmacion_reservas" action="paginausuario_reservar2.php" method="GET">
				<center><table class="mytable">
					<tr>
						<th>Tipo Recurso:</th>
					    <th>Recurso:</th>
					    <th>Estado:</th>
					</tr>
					<?php
						if (!isset($_REQUEST['idresource'])){
							echo "<td>Por favor, vuelve atras, ha sucedido un error.</td>";
							echo "<td>Por favor, vuelve atras, ha sucedido un error.</td>";
							echo "<td>Por favor, vuelve atras, ha sucedido un error.</td>";
							echo "</tr></table><br><br>";
							echo "<a href=paginausuario_reservar.php>Volver</a>";
						}else{
							$id=$_REQUEST['idresource'];
							$conn=mysqli_connect('localhost','root','','bd_intranet');
							$sql="SELECT resources.*, resourcestype.*, estadoinfo.* FROM ((resourcestype INNER JOIN resources ON resourcestype.idRType=resources.idRType) INNER JOIN estadoinfo ON resources.idEstado=estadoinfo.idEstado) WHERE resources.idResource=".$id;
							$datos=mysqli_query($conn,$sql);
							while($valor=mysqli_fetch_array($datos)){
							    echo "<tr>";
								    echo "<td>".$valor['tipo']."</td>";
								    echo "<td>".$valor['nomR']."</td>";
								    echo "<td>".$valor['nomEstado']."</td>";
								    $_SESSION['resRecurso']=$valor['idResource'];
								echo "</tr>";     
							}

						}
					?>
				</table>
				<br>Selecciona una fecha de <b>inicio</b> para la reserva:
				<br><input type="date" name="data_ini" min="<?php echo date("Y-m-d");?>"value="<?php echo date("Y-m-d");?>" required><br><br>
				<select name="franjahoraria">
					<?php
					$conn=mysqli_connect('localhost','root','','bd_intranet');
					$sql="SELECT * FROM hours";
					$datos=mysqli_query($conn,$sql);
					while($nom=mysqli_fetch_array($datos)){
	               		echo "<option value='$nom[idFranja]'>".utf8_encode($nom['franja'])."</option>";
	               	}
					?>
				</select>
				<br><br><br><input type='submit' value='Reservar' name='reservar'>
			</form>
		<?php
			}
		?>
	</body>
</html>








