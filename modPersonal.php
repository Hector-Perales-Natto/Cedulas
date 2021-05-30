<?php
include_once "Connections/cedulas.php";

$cve_per = $_GET['recordID'];

try {
    $sql = "SELECT * FROM empleados WHERE Id = ?";
    $borraEmp = $conexion->prepare($sql);
    $borraEmp->execute(array($cve_per));
    $empleados = $borraEmp->fetch(PDO::FETCH_ASSOC);

    $sqlGra = "SELECT * FROM grados ORDER BY Id";
    $gra = $conexion->prepare($sqlGra);
    $gra->execute();
    $grado = $gra->fetch(PDO::FETCH_ASSOC);

    $sqlDep = "SELECT * FROM departamentos ORDER BY cve_depto";
    $dep = $conexion->prepare($sqlDep);
    $dep->execute();
    $depto = $dep->fetch(PDO::FETCH_ASSOC);

    $sqlPto = "SELECT * FROM puestos ORDER BY Id";
    $pto = $conexion->prepare($sqlPto);
    $pto->execute();
    $puesto = $pto->fetch(PDO::FETCH_ASSOC);

    $sqlNiv = "SELECT * FROM niveles ORDER BY Id";
    $niv = $conexion->prepare($sqlNiv);
    $niv->execute();
    $nivel = $niv->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo $e->getMessage();
}
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
<body onload="registrar.nombre.focus()">
	<div class="contenido">
		<div class="row justify-content-center">
		<form name="registrar" class="form" method="POST" enctype="multipart/form-data">
			<table class="table table-sm col-2">
				<tr><th>MODIFICA CEDULA</th></tr>
				<tr>
					<th>Clave de cedula:</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="clave" style="width: 800px;" value="<?php echo str_pad($empleados['Id'], 5, "0", STR_PAD_LEFT); ?>" readonly>
				</td>
				</tr>
				<tr>
					<th>Nombre (nombre(s), apellidos paterno y materno):</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" required name="nombre" placeholder="Nombre" value="<?php echo $empleados['nombre']; ?>">
				</td>
				</tr>
				<tr>
					<th>Grado (academico o social):</th>
				</tr>
				<tr>
				<td class="form-group">
					<select name="grado" class="form-control">
						<option value="0" disabled selected>-- Seleccione una Opción --</option>
						<?php
do {
    ?>
						<option value="<?php echo $grado['Id']; ?>"<?php if (!(strcmp($grado['Id'], $empleados['grado']))) {echo "SELECTED";}?>><?php echo $grado['grado']; ?></option>
						<?php
} while ($grado = $gra->fetch(PDO::FETCH_ASSOC));
?>
					</select>
				</td>
				</tr>
				<tr>
					<th>Fecha de vigencia:</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="date" class="form-control" required name="vigencia" placeholder="Vigencia" value="<?php echo $empleados['vigencia']; ?>">
				</td>
				</tr>
				<tr>
					<th>Area:</th>
				</tr>
				<tr>
				<td class="form-group">
					<select name="departamento" class="form-control">
						<option value="0" disabled selected>-- Seleccione una Opción --</option>
						<?php
do {
    if ($depto['abreviatura'] != null) {
        ?>
								<option value="<?php echo $depto['cve_depto']; ?>"<?php if (!(strcmp($depto['cve_depto'], $empleados['departamento']))) {echo "SELECTED";}?>><?php echo $depto['departamento'] . " / " . $depto['abreviatura']; ?></option>
							<?php
} else {
        ?>
								<option value="<?php echo $depto['cve_depto']; ?>"<?php if (!(strcmp($depto['cve_depto'], $empleados['departamento']))) {echo "SELECTED";}?>><?php echo $depto['departamento']; ?></option>
						<?php
}
} while ($depto = $dep->fetch(PDO::FETCH_ASSOC));
?>
					</select>
				</td>
				</tr>
				<tr>
					<th>Nivel:</th>
				</tr>
				<tr>
				<td class="form-group">
					<select name="nivel" id="nivel" class="form-control">
						<option value="0" disabled selected>-- Seleccione una Opción --</option>
						<?php
do {
    ?>
						<option value="<?php echo $nivel['Id']; ?>"<?php if (!(strcmp($nivel['Id'], $empleados['nivel']))) {echo "SELECTED";}?>><?php echo $nivel['nivel']; ?></option>
						<?php
} while ($nivel = $niv->fetch(PDO::FETCH_ASSOC));
?>
					</select>
				</td>
				</tr>
				<tr>
					<th>Puesto:</th>
				</tr>
				<tr>
				<td class="form-group">
					<select name="puesto" class="form-control">
						<option value="0" disabled selected>Puestos</option>
						<?php
do {
    ?>
						<option value="<?php echo $puesto['Id']; ?>"<?php if (!(strcmp($puesto['Id'], $empleados['puesto']))) {echo "SELECTED";}?>><?php echo $puesto['puesto']; ?></option>
						<?php
} while ($puesto = $pto->fetch(PDO::FETCH_ASSOC));
?>
					</select>
				</td>
				</tr>
				<tr>
				<td class="text-secondary" style="text-align: center; background-color: #2388E5" colspan="2"><span style="color:#FFF">CEDULA FIRMADA EN PDF</span></td>
				</tr>
				<tr>
					<td class="form-group" colspan="2">
						<input type="file" name="archivo" id="archivo" accept=".pdf" class="form-control" style="height:38px; font-size:12px;">
					</td>
				</tr>
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
if (isset($_POST['guardar'])) {
    $clave = $_POST['clave'];
    $nombre = strtoupper(htmlspecialchars($_POST['nombre']));
    $grado = $_POST['grado'];
    $vigencia = $_POST['vigencia'];
    $departamento = $_POST['departamento'];
    $puesto = $_POST['puesto'];
    $nivel = $_POST['nivel'];

    $existente = $empleados['archivo'];

    if (!empty($_FILES['archivo']['name'])) {
        $destino = 'pdf';
        $archivo = $_FILES['archivo']['name'];
        $nomArchivo = pathinfo($_FILES['archivo']['name'], PATHINFO_FILENAME);
        $nueva_ext = explode(".", $_FILES['archivo']['name']);
        $extension = end($nueva_ext);
        $archivoCompleto = 'cedula_' . $nomArchivo . '.' . $extension;

        if ($existente != null) {
            unlink($destino . '/' . $existente);
        }

        if (!copy($_FILES['archivo']['tmp_name'], $destino . '/' . $archivoCompleto)) {
            echo "<SCRIPT LANGUAGE=\"JavaScript\">\n" . "<!-- Hide from older browsers \n" . "alert('No se pueden subir archivos con pesos mayores a 2MB'); \n" . " --> \n " . "</SCRIPT>";
            $archivo = '';
            echo "<SCRIPT LANGUAGE=\"JavaScript\">\n" . "<!-- Hide from older browsers \n" . "window.location.href='index.php?pagina=lista_mod_personal.php'; \n" . " --> \n " . "</SCRIPT>";
        }
    } else {
        $archivoCompleto = $empleados['archivo'];
    }

    try {
        $sql_up = "UPDATE empleados SET nombre = ?, grado = ?, vigencia = ?, departamento = ?, nivel = ?, puesto = ?, archivo = ? WHERE Id = ?";
        $stmt = $conexion->prepare($sql_up);
        $stmt = $stmt->execute(array($nombre, $grado, $vigencia, $departamento, $nivel, $puesto, $archivoCompleto, $clave));

        echo '<script type="text/javascript">
				swal({
					position: "top",
					text: "Has modificado la cedula con exito!",
					confirmButtonColor: "#DD6B55"
				}).then(function() {
					window.location.href = "index.php?pagina=lista_mod_personal.php";
				});
				</script>';
    } catch (PDOException $e) {
        echo '<script type="text/javascript">
				swal({
					position: "top",
					text: "Problemas para realizar la modificación!",
					confirmButtonColor: "#DD6B55"
				}).then(function() {
					window.location.href = "index.php?pagina=lista_mod_personal.php";
				});
				</script>';
        $e->getMessage();
    }
}
?>