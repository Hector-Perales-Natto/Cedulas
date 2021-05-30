<?php 
include_once("Connections/cedulas.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CEFA</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
    
    <style>
        body {
            background-color: #eef5f9;
        }
    </style>
</head>
<body onload="registrar.clave.focus()">
	<div class="contenido">
		<div class="row justify-content-center">
		<form name="registrar" class="form" method="POST" style="Width: 1000px;">
			<table class="table">
				<tr><th>ALTA DE DEPARTAMENTOS</th></tr>	
				<tr>
				<td>
					<input type="text" class="form-control" name="clave" placeholder="Clave del Departamento" required>					
				</td>
				</tr>							                				
				<tr>
				<td>
					<input type="text" class="form-control" name="departamento" placeholder="Nombre del Departamento" required>			
				</td>
				</tr>
				<tr>
				<td>
					<input type="text" class="form-control" name="abreviatura" placeholder="Abreviatura del Nombre del Departamento">					
				</td>
				</tr>
				<?php
				for($i = 1; $i < 52; $i++ ) {
					try {
						$sqlfac = "SELECT * FROM facultades ORDER BY clave";
						$fac = $conexion->prepare($sqlfac);
						$fac->execute();
						$facultad = $fac->fetch(PDO::FETCH_ASSOC);							
					}catch(PDOException $e) {
						echo $e->getMessage();
					}										
				?>
				<tr>
				<td class="form-group">
					<select name="facultad_<?Php echo $i ?>" class="form-control">
						<option value="0" disabled selected>-- Seleccione una Opción de Facultades --</option>
						<?php
						do {
						?>
						<option value="<?php echo $facultad['clave']; ?>"><?php echo $facultad['facultad']; ?></option>
						<?php
						} while ($facultad = $fac->fetch(PDO::FETCH_ASSOC));
						?>
					</select>
				</td>
				</tr>
				<?php
				}				
				?>
				<tr>
				<td class="form-group">
					<button type="submit" class="btn btn-primary" name="guardar" id="guardar" value="&rarr;">Guardar</button>
				</td>
				</tr>	
			</table>		
		</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">  	
	</script>
	<script src="js/sweetalert2.min.js"></script>	
</body>
</html>
<?php
if(isset($_POST['guardar'])) {
	$clave = strtoupper(htmlspecialchars($_POST['clave']));
	$departamento = strtoupper(htmlspecialchars($_POST['departamento']));
	
	if(!empty($_POST['abreviatura'])) {
		$abreviatura = strtoupper(htmlspecialchars($_POST['abreviatura']));
	} else {
		$abreviatura = null;
	}	

	$facultad_1 = htmlspecialchars($_POST['facultad_1']);
	$facultad_2 = htmlspecialchars($_POST['facultad_2']);
	$facultad_3 = htmlspecialchars($_POST['facultad_3']);
	$facultad_4 = htmlspecialchars($_POST['facultad_4']);
	$facultad_5 = htmlspecialchars($_POST['facultad_5']);
	$facultad_6 = htmlspecialchars($_POST['facultad_6']);
	$facultad_7 = htmlspecialchars($_POST['facultad_7']);
	$facultad_8 = htmlspecialchars($_POST['facultad_8']);
	$facultad_9 = htmlspecialchars($_POST['facultad_9']);
	$facultad_10 = htmlspecialchars($_POST['facultad_10']);
	$facultad_11 = htmlspecialchars($_POST['facultad_11']);
	$facultad_12 = htmlspecialchars($_POST['facultad_12']);
	$facultad_13 = htmlspecialchars($_POST['facultad_13']);
	$facultad_14 = htmlspecialchars($_POST['facultad_14']);
	$facultad_15 = htmlspecialchars($_POST['facultad_15']);
	$facultad_16 = htmlspecialchars($_POST['facultad_16']);
	$facultad_17 = htmlspecialchars($_POST['facultad_17']);
	$facultad_18 = htmlspecialchars($_POST['facultad_18']);
	$facultad_19 = htmlspecialchars($_POST['facultad_19']);
	$facultad_20 = htmlspecialchars($_POST['facultad_20']);
	$facultad_21 = htmlspecialchars($_POST['facultad_21']);
	$facultad_22 = htmlspecialchars($_POST['facultad_22']);
	$facultad_23 = htmlspecialchars($_POST['facultad_23']);
	$facultad_24 = htmlspecialchars($_POST['facultad_24']);
	$facultad_25 = htmlspecialchars($_POST['facultad_25']);
	$facultad_26 = htmlspecialchars($_POST['facultad_26']);
	$facultad_27 = htmlspecialchars($_POST['facultad_27']);
	$facultad_28 = htmlspecialchars($_POST['facultad_28']);
	$facultad_29 = htmlspecialchars($_POST['facultad_29']);
	$facultad_30 = htmlspecialchars($_POST['facultad_30']);
	$facultad_31 = htmlspecialchars($_POST['facultad_31']);
	$facultad_32 = htmlspecialchars($_POST['facultad_32']);
	$facultad_33 = htmlspecialchars($_POST['facultad_33']);
	$facultad_34 = htmlspecialchars($_POST['facultad_34']);
	$facultad_35 = htmlspecialchars($_POST['facultad_35']);
	$facultad_36 = htmlspecialchars($_POST['facultad_36']);
	$facultad_37 = htmlspecialchars($_POST['facultad_37']);
	$facultad_38 = htmlspecialchars($_POST['facultad_38']);
	$facultad_39 = htmlspecialchars($_POST['facultad_39']);
	$facultad_40 = htmlspecialchars($_POST['facultad_40']);
	$facultad_41 = htmlspecialchars($_POST['facultad_41']);
	$facultad_42 = htmlspecialchars($_POST['facultad_42']);
	$facultad_43 = htmlspecialchars($_POST['facultad_43']);
	$facultad_44 = htmlspecialchars($_POST['facultad_44']);
	$facultad_45 = htmlspecialchars($_POST['facultad_45']);
	$facultad_46 = htmlspecialchars($_POST['facultad_46']);
	$facultad_47 = htmlspecialchars($_POST['facultad_47']);
	$facultad_48 = htmlspecialchars($_POST['facultad_48']);
	$facultad_49 = htmlspecialchars($_POST['facultad_49']);
	$facultad_50 = htmlspecialchars($_POST['facultad_50']);
	$facultad_51 = htmlspecialchars($_POST['facultad_51']);
	$facultad_52 = htmlspecialchars($_POST['facultad_52']);

	$sql = "SELECT * FROM departamentos WHERE cve_depto = ? || departamento = ?";
	$stmt = $conexion->prepare($sql);
	$stmt->execute(array($clave, $departamento));
	$checaDepto = $stmt->fetch(PDO::FETCH_ASSOC);

	if($checaDepto) {
		echo '<script type="text/javascript">
					swal({
						position: "top",
				 		text: "Este departamento ya está registrado!",
				 		confirmButtonColor: "#DD6B55"
			 		}).then(function() {
						window.location.href = "index.php?pagina=regDepto.php";
					});
	    			</script>';
	} else {				
		try {
			$sql = "INSERT INTO departamentos (cve_depto, departamento, abreviatura, fac_1, fac_2, fac_3, fac_4, fac_5, fac_6, fac_7, fac_8, fac_9, fac_10, fac_11, fac_12, fac_13, fac_14, fac_15, fac_16, fac_17, fac_18, fac_19, fac_20, fac_21, fac_22, fac_23, fac_24, fac_25, fac_26, fac_27, fac_28, fac_29, fac_30, fac_31, fac_32, fac_33, fac_34, fac_35, fac_36, fac_37, fac_38, fac_39, fac_40, fac_41, fac_42, fac_43, fac_44, fac_45, fac_46, fac_47, fac_48, fac_49, fac_50, fac_51, fac_52, baja) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $conexion->prepare($sql);
			$stmt->execute(array($clave, $departamento, $abreviatura, $facultad_1, $facultad_2, $facultad_3, $facultad_4, $facultad_5, $facultad_6, $facultad_7, $facultad_8, $facultad_9, $facultad_10, $facultad_11, $facultad_12, $facultad_13, $facultad_14, $facultad_15, $facultad_16, $facultad_17, $facultad_18, $facultad_19, $facultad_20, $facultad_21, $facultad_22, $facultad_23, $facultad_24, $facultad_25, $facultad_26, $facultad_27, $facultad_28, $facultad_29, $facultad_30, $facultad_31, $facultad_32, $facultad_33, $facultad_34, $facultad_35, $facultad_36, $facultad_37, $facultad_38, $facultad_39, $facultad_40, $facultad_41, $facultad_42, $facultad_43, $facultad_44, $facultad_45, $facultad_46, $facultad_47, $facultad_48, $facultad_49, $facultad_50, $facultad_51, $facultad_52, 0));
			echo '<script type="text/javascript">
					swal({
						position: "top",
						text: "Has creado un nuevo departamento exitosamente!",
						confirmButtonColor: "#DD6B55"
					}).then(function() {
						window.location.href = "index.php?pagina=regDepto.php";
					});
					</script>';
		}catch(PDOException $e) {
			echo '<script type="text/javascript">
					swal({
						position: "top",
						text: "Problemas para realizar el registro!",
						confirmButtonColor: "#DD6B55"
					}).then(function() {
						window.location.href = "index.php?pagina=regDepto.php";
					});
					</script>';
			$e->getMessage();
		}		
	}
}
?>