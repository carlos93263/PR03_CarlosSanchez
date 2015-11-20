<link rel="stylesheet" href="css/tablareservas.css">
<!DOCTYPE html>
<html>
	<head>
		<title>  </title>
		<meta charset="UTF-8">
		<!-- FUNCION DE JAVASCRIPT QUE SE ENCARGARA DE RECARGAR LA PAGINA CADA VEZ QUE MODIFIQUEMOS EL SELECT="tipo_recurso" -->
		<script type="text/javascript">
			function OnSelectionChange (select){
				//var selectedOption = select.value;
				//alert ("The selected option is " + selectedOption);
				document.formulario_reservas.submit();
			}
					
		</script>
	</head>
	<body>
<!-- DIV EN EL QUE SE METE TODO LO REFERENTE AL FORMULARIO (LOS 3 SELECTS I EL SUBMIT) -->
		<div id="desplegables">
			<!-- FORMULARIO CON LOS 3 SELECT -->
			<form name="formulario_reservas" action="paginausuario_reservar.php" method="POST">
				<!-- DENTRO DEL FORMULARIO SE AÑADE UN IF QUE COMPRUEVA SI LA VARIABLE DEL SELECT name="tiporecursos" EXISTE O NO -->
				<?php
				if (!isset($_REQUEST['tiporecursos'])){
					//EN EL CASO DE QUE NO EXISTA, EJECUTA EL SIGUIENTE CODIGO.
					//Conexion a la BBDD.
					$conn=mysqli_connect('mysql.hostinger.es','u467566146_admin','1234567890','u467566146_intra');
					//Almacenar la consulta SQL en una variable.
	                $consulta_Rtype="SELECT idRType, tipo FROM resourcestype";
	                //Almacenar resultado de consulta en un Array.
	                $datos=mysqli_query($conn,$consulta_Rtype);
		        ?>
					<div id="div_izq"><h3>Tipus de recurs:</h3>
						<!-- Creacion del primer SELECT name="tiporecursos" que ejecutara la funcion OnSelectionChange() declarada arriba -->
						<select name="tiporecursos" onchange="OnSelectionChange(this)">
				            <?php
				            	//Mostramos el contenido del Array, mostrando por defecto la opcion 12, que es Todos los tipos de recursos.
				            	while($nom=mysqli_fetch_array($datos)){
				               		echo "<option value='$nom[idRType]' selected=$nom[12]>".utf8_encode($nom['tipo'])."</option>";
				               	}
				            ?>   	
			            </select>
		        	</div>
			        	
			    <?php
	            }else{
	            	//EN EL CASO DE QUE SI EXISTA EJECUTA EL SIGUIENTE CODIGO.
	            	$conn=mysqli_connect('mysql.hostinger.es','u467566146_admin','1234567890','u467566146_intra');
	            	$consulta_Rtype="SELECT idRType, tipo FROM resourcestype";
					$datos=mysqli_query($conn,$consulta_Rtype);
		        ?>
		        	<div id="div_izq"><h3>Tipus de recurs:</h3>
						<select name="tiporecursos" onchange="OnSelectionChange (this)">
				            <?php
				            	while($nom=mysqli_fetch_array($datos)){
				               		echo "<option value='$nom[idRType]'";
				               		if($_REQUEST['tiporecursos']==$nom['idRType']) echo "selected";
				               		echo ">".utf8_encode($nom['tipo'])."</option>";
				               	}
				            ?>
			            </select>
			    <?php
		        }
	       		?>
	       		<br>
	       		
	       		<div id="div_boton"><input type="submit" value="Filtrar"></div>
	       	</form>
        </div>


 <!-- DIV PARA TODO LO REFERENTE A CONSULTAS. -->
        <div>
        	<br>
        	<center><table class="mytable">
        		<tr>
        			<th>Tipo Recurso:</th>
        			<th>Recurso:</th>
        			<th>Reservar:</th>
        		</tr>
		        	<?php
		        		if ((!isset($_REQUEST['tiporecursos'])) OR ($_REQUEST['tiporecursos']==12)){
			        		$conn=mysqli_connect('mysql.hostinger.es','u467566146_admin','1234567890','u467566146_intra');
					        $sql="SELECT resources.*, resourcestype.*, estadoinfo.* FROM ((resourcestype INNER JOIN resources ON resourcestype.idRType=resources.idRType) INNER JOIN estadoinfo ON resources.idEstado=estadoinfo.idEstado)";
					       	$datos=mysqli_query($conn,$sql);
					        $num_filas = mysqli_num_rows($datos);
					        if ($num_filas!=0){
						        while($valor=mysqli_fetch_array($datos)){
								    echo "<tr>";
									    echo "<td>".$valor['tipo']."</td>";
									    echo "<td>".$valor['nomR']."</td>";
									    echo "<td><a href=paginausuario_reservar2.php?idresource=".$valor['idResource'].">Reservar</a></td>";
									echo "</tr>";
								}
							} else {
								echo "<tr>";
									echo "<td>No se han encontrado resultados.</td>";
									echo "<td>No se han encontrado resultados.</td>";
									echo "<td>No se han encontrado resultados.</td>";
								echo "</tr>";
							}
						} else {
							$conn=mysqli_connect('mysql.hostinger.es','u467566146_admin','1234567890','u467566146_intra');
							$sql="SELECT resources.*, resourcestype.*, estadoinfo.* FROM ((resourcestype INNER JOIN resources ON resourcestype.idRType=resources.idRType) INNER JOIN estadoinfo ON resources.idEstado=estadoinfo.idEstado)";
					        $sql.=" WHERE";
					        $sql.=" resources.idRType=$_REQUEST[tiporecursos]";
					        $datos=mysqli_query($conn,$sql);
					        $num_filas = mysqli_num_rows($datos);
					        if ($num_filas!=0){
						        while($valor=mysqli_fetch_array($datos)){
								    echo "<tr>";
									    echo "<td>".$valor['tipo']."</td>";
									    echo "<td>".$valor['nomR']."</td>";
									    echo "<td><a href=paginausuario_reservar2.php?idresource=".$valor['idResource'].">Reservar</a></td>";
									echo "</tr>";
								}
							} else {
								echo "<tr>";
									echo "<td>No se han encontrado resultados.</td>";
									echo "<td>No se han encontrado resultados.</td>";
									echo "<td>No se han encontrado resultados.</td>";
								echo "</tr>";
							}
						}
		        	?>
        	</table></center>
        </div>
	</body>
</html>