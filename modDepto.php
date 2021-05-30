<?php 
include_once("Connections/cedulas.php");

$cve_dep = $_GET['recordID'];

try {
	$sqlDep = "SELECT * FROM departamentos WHERE cve_depto = ?";
	$dep = $conexion->prepare($sqlDep);
	$dep->execute(array($cve_dep));
	$depto = $dep->fetch(PDO::FETCH_ASSOC);	
}catch(PDOException $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
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
				<tr><th>MODIFICA DEPARTAMENTO</th></tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="clave" placeholder="clave" value="<?php echo $depto['cve_depto']; ?>" required>
				</td>
				</tr>
				<tr>
				<td class="form-group">
				<input type="text" class="form-control" name="departamento" placeholder="Departamento" value="<?php echo $depto['departamento']; ?>" required>
				</td>
				</tr>
				<tr>
				<td>
					<input type="text" class="form-control" name="abreviatura" placeholder="Abreviatura del Nombre del Departamento" value="<?php echo $depto['abreviatura']; ?>">					
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
						<option value="<?php echo $facultad['clave']; ?>"<?php if (!(strcmp($facultad['clave'], $depto['fac_'.$i]))) {echo "SELECTED";} ?>><?php echo $facultad['facultad']; ?></option>
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

	$facultad_1 = null; 
	$facultad_2 = null; 
	$facultad_3 = null;
	$facultad_4 = null;
	$facultad_5 = null; 
	$facultad_6 = null;
	$facultad_7 = null;
	$facultad_8 = null;
	$facultad_9 = null;
	$facultad_10 = null; 
	$facultad_11 = null;
	$facultad_12 = null;
	$facultad_13 = null;
	$facultad_14 = null;
	$facultad_15 = null;
	$facultad_16 = null;
	$facultad_17 = null;
	$facultad_18 = null;
	$facultad_19 = null;
	$facultad_20 = null;
	$facultad_21 = null;
	$facultad_22 = null;
	$facultad_23 = null;
	$facultad_24 = null;
	$facultad_25 = null;
	$facultad_26 = null;
	$facultad_27 = null;
	$facultad_28 = null;
	$facultad_29 = null;
	$facultad_30 = null;
	$facultad_31 = null;
	$facultad_32 = null;
	$facultad_33 = null;
	$facultad_34 = null;
	$facultad_35 = null;
	$facultad_36 = null;
	$facultad_37 = null;
	$facultad_38 = null;
	$facultad_39 = null;
	$facultad_40 = null;
	$facultad_41 = null;
	$facultad_42 = null;
	$facultad_43 = null;
	$facultad_44 = null;
	$facultad_45 = null;
	$facultad_46 = null;
	$facultad_47 = null;
	$facultad_48 = null;
	$facultad_49 = null;
	$facultad_50 = null;
	$facultad_51 = null;
	$facultad_52 = null;
	
	if(isset($_POST['facultad_1'])) {	
		$facultad_1 = htmlspecialchars($_POST['facultad_1']);
	}
	
	if(isset($_POST['facultad_2'])) {	
		$facultad_2 = htmlspecialchars($_POST['facultad_2']);
	}
	
	if(isset($_POST['facultad_3'])) {	
		$facultad_3 = htmlspecialchars($_POST['facultad_3']);
	} 

	if(isset($_POST['facultad_4'])) {	
		$facultad_4 = htmlspecialchars($_POST['facultad_4']);
	}

	if(isset($_POST['facultad_5'])) {	
		$facultad_5 = htmlspecialchars($_POST['facultad_5']);
	}

	if(isset($_POST['facultad_6'])) {	
		$facultad_6 = htmlspecialchars($_POST['facultad_6']);
	}

	if(isset($_POST['facultad_7'])) {	
		$facultad_7 = htmlspecialchars($_POST['facultad_7']);
	}

	if(isset($_POST['facultad_8'])) {	
		$facultad_8 = htmlspecialchars($_POST['facultad_8']);
	}

	if(isset($_POST['facultad_9'])) {	
		$facultad_9 = htmlspecialchars($_POST['facultad_9']);
	}

	if(isset($_POST['facultad_10'])) {	
		$facultad_10 = htmlspecialchars($_POST['facultad_10']);	
	}
	
	if(isset($_POST['facultad_11'])) {	
		$facultad_11 = htmlspecialchars($_POST['facultad_11']);	
	}

	if(isset($_POST['facultad_12'])) {	
		$facultad_12 = htmlspecialchars($_POST['facultad_12']);
	}

	if(isset($_POST['facultad_13'])) {	
		$facultad_13 = htmlspecialchars($_POST['facultad_13']);
	}

	if(isset($_POST['facultad_14'])) {	
		$facultad_14 = htmlspecialchars($_POST['facultad_14']);
	}

	if(isset($_POST['facultad_15'])) {	
		$facultad_15 = htmlspecialchars($_POST['facultad_15']);
	}

	if(isset($_POST['facultad_16'])) {	
		$facultad_16 = htmlspecialchars($_POST['facultad_16']);
	}

	if(isset($_POST['facultad_17'])) {	
		$facultad_17 = htmlspecialchars($_POST['facultad_17']);
	}

	if(isset($_POST['facultad_18'])) {	
		$facultad_18 = htmlspecialchars($_POST['facultad_18']);
	}

	if(isset($_POST['facultad_19'])) {	
		$facultad_19 = htmlspecialchars($_POST['facultad_19']);
	}

	if(isset($_POST['facultad_20'])) {	
		$facultad_20 = htmlspecialchars($_POST['facultad_20']);
	}

	if(isset($_POST['facultad_21'])) {	
		$facultad_21 = htmlspecialchars($_POST['facultad_21']);
	}

	if(isset($_POST['facultad_22'])) {	
		$facultad_22 = htmlspecialchars($_POST['facultad_22']);
	}

	if(isset($_POST['facultad_23'])) {	
		$facultad_23 = htmlspecialchars($_POST['facultad_23']);
	}

	if(isset($_POST['facultad_24'])) {	
		$facultad_24 = htmlspecialchars($_POST['facultad_24']);
	}

	if(isset($_POST['facultad_25'])) {	
		$facultad_25 = htmlspecialchars($_POST['facultad_25']);
	}

	if(isset($_POST['facultad_26'])) {	
		$facultad_26 = htmlspecialchars($_POST['facultad_26']);
	}

	if(isset($_POST['facultad_27'])) {	
		$facultad_27 = htmlspecialchars($_POST['facultad_27']);
	}

	if(isset($_POST['facultad_28'])) {	
		$facultad_28 = htmlspecialchars($_POST['facultad_28']);
	}

	if(isset($_POST['facultad_29'])) {	
		$facultad_29 = htmlspecialchars($_POST['facultad_29']);
	}

	if(isset($_POST['facultad_30'])) {	
		$facultad_30 = htmlspecialchars($_POST['facultad_30']);
	}

	if(isset($_POST['facultad_31'])) {	
		$facultad_31 = htmlspecialchars($_POST['facultad_31']);
	}

	if(isset($_POST['facultad_32'])) {	
		$facultad_32 = htmlspecialchars($_POST['facultad_32']);
	}

	if(isset($_POST['facultad_33'])) {	
		$facultad_33 = htmlspecialchars($_POST['facultad_33']);
	}

	if(isset($_POST['facultad_34'])) {	
		$facultad_34 = htmlspecialchars($_POST['facultad_34']);
	}

	if(isset($_POST['facultad_35'])) {	
		$facultad_35 = htmlspecialchars($_POST['facultad_35']);
	}

	if(isset($_POST['facultad_36'])) {	
		$facultad_36 = htmlspecialchars($_POST['facultad_36']);
	}

	if(isset($_POST['facultad_37'])) {	
		$facultad_37 = htmlspecialchars($_POST['facultad_37']);
	}

	if(isset($_POST['facultad_38'])) {	
		$facultad_38 = htmlspecialchars($_POST['facultad_38']);
	}

	if(isset($_POST['facultad_39'])) {	
		$facultad_39 = htmlspecialchars($_POST['facultad_39']);
	}

	if(isset($_POST['facultad_40'])) {	
		$facultad_40 = htmlspecialchars($_POST['facultad_40']);
	}

	if(isset($_POST['facultad_41'])) {	
		$facultad_41 = htmlspecialchars($_POST['facultad_41']);
	}

	if(isset($_POST['facultad_42'])) {	
		$facultad_42 = htmlspecialchars($_POST['facultad_42']);
	}

	if(isset($_POST['facultad_43'])) {	
		$facultad_43 = htmlspecialchars($_POST['facultad_43']);
	}

	if(isset($_POST['facultad_44'])) {	
		$facultad_44 = htmlspecialchars($_POST['facultad_44']);
	}

	if(isset($_POST['facultad_45'])) {	
		$facultad_45 = htmlspecialchars($_POST['facultad_45']);
	}

	if(isset($_POST['facultad_46'])) {	
		$facultad_46 = htmlspecialchars($_POST['facultad_46']);
	}

	if(isset($_POST['facultad_47'])) {	
		$facultad_47 = htmlspecialchars($_POST['facultad_47']);
	}

	if(isset($_POST['facultad_48'])) {	
		$facultad_48 = htmlspecialchars($_POST['facultad_48']);
	}

	if(isset($_POST['facultad_49'])) {	
		$facultad_49 = htmlspecialchars($_POST['facultad_49']);
	}

	if(isset($_POST['facultad_50'])) {	
		$facultad_50 = htmlspecialchars($_POST['facultad_50']);
	}

	if(isset($_POST['facultad_51'])) {	
		$facultad_51 = htmlspecialchars($_POST['facultad_51']);
	}

	if(isset($_POST['facultad_52'])) {	
		$facultad_52 = htmlspecialchars($_POST['facultad_52']);   
	}
	
	try {
		$sql_up = "UPDATE departamentos SET cve_depto = ?, departamento = ?,  abreviatura = ?, fac_1 = ?, fac_2 = ?, fac_3 = ?, fac_4 = ?, fac_5 = ?, fac_6 = ?, fac_7 = ?, fac_8 = ?, fac_9 = ?, fac_10 = ?, fac_11 = ?, fac_12 = ?, fac_13 = ?, fac_14 = ?, fac_15 = ?, fac_16 = ?, fac_17 = ?, fac_18 = ?, fac_19 = ?, fac_20 = ?, fac_21 = ?, fac_22 = ?, fac_23 = ?, fac_24 = ?, fac_25 = ?, fac_26 = ?, fac_27 = ?, fac_28 = ?, fac_29 = ?, fac_30 = ?, fac_31 = ?, fac_32 = ?, fac_33 = ?, fac_34 = ?, fac_35 = ?, fac_36 = ?, fac_37 = ?, fac_38 = ?, fac_39 = ?, fac_40 = ?, fac_41 = ?, fac_42 = ?, fac_43 = ?, fac_44 = ?, fac_45 = ?, fac_46 = ?, fac_47 = ?, fac_48 = ?, fac_49 = ?, fac_50 = ?, fac_51 = ?, fac_52 = ?, baja = ? WHERE cve_depto = ?";
		$stmt = $conexion->prepare($sql_up);
        $stmt = $stmt->execute(array($clave, $departamento, $abreviatura, $facultad_1, $facultad_2, $facultad_3, $facultad_4, $facultad_5, $facultad_6, $facultad_7, $facultad_8, $facultad_9, $facultad_10, $facultad_11, $facultad_12, $facultad_13, $facultad_14, $facultad_15, $facultad_16, $facultad_17, $facultad_18, $facultad_19, $facultad_20, $facultad_21, $facultad_22, $facultad_23, $facultad_24, $facultad_25, $facultad_26, $facultad_27, $facultad_28, $facultad_29, $facultad_30, $facultad_31, $facultad_32, $facultad_33, $facultad_34, $facultad_35, $facultad_36, $facultad_37, $facultad_38, $facultad_39, $facultad_40, $facultad_41, $facultad_42, $facultad_43, $facultad_44, $facultad_45, $facultad_46, $facultad_47, $facultad_48, $facultad_49, $facultad_50, $facultad_51, $facultad_52, 0,  $clave));
				
		if($stmt) {
			echo '<script type="text/javascript">
						swal({
							position: "top",
							text: "Departamento modificado exitosamente!",
							confirmButtonColor: "#DD6B55"
						}).then(function() {
							window.location.href = "index.php?pagina=lista_mod_depto.php";
						});
					</script>';
		}			
	}catch(PDOException $e) {
		echo '<script type="text/javascript">
					swal({
						position: "top",
						text: "Problemas para realizar la modificación!",
						confirmButtonColor: "#DD6B55"
					}).then(function() {
						window.location.href = "index.php?pagina=lista_mod_depto.php";
					});
				</script>';
		$e->getMessage();
	}		
}
?>