<?php
include_once "Connections/cedulas.php";

try {
    $sqlGra = "SELECT * FROM grados ORDER BY id";
    $gra = $conexion->prepare($sqlGra);
    $gra->execute();
    $grado = $gra->fetch(PDO::FETCH_ASSOC);

    $sqlDep = "SELECT * FROM departamentos ORDER BY cve_depto";
    $dep = $conexion->prepare($sqlDep);
    $dep->execute();
    $depto = $dep->fetch(PDO::FETCH_ASSOC);

    $sqlPto = "SELECT * FROM puestos ORDER BY puesto";
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

	<script language="javascript">
		function valida(f) {
			var ok = true;
			var msg = "Debes seleccionar una opción:\n";
			if (f.elements["grado"].value == 0) {
				msg += "- Grado (academico o social)\n";
				ok = false;
			}

			if (f.elements["departamento"].value == 0) {
				msg += "- Area\n";
				ok = false;
			}

			if (f.elements["puesto"].value == 0) {
				msg += "- Puesto\n";
				ok = false;
			}

			if (ok == false)
				alert(msg);
			return ok;
		}
	</script>

    <style>
        body {
            background-color: #eef5f9;
        }
    </style>
</head>
<body onload="registrar.nombre.focus()">
	<div class="contenido">
		<div class="row justify-content-center">
		<form name="registrar" class="form" method="POST" enctype="multipart/form-data" onsubmit="return valida(this)" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<table class="table table-sm col-2">
				<tr><th>ALTA DE CEDULA</th></tr>
				<tr>
					<th>Nombre (nombre(s), apellidos paterno y materno):</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="nombre" id="nombre" style="width: 800px;" required>
				</td>
				</tr>
				<tr>
					<th>Grado (academico o social):</th>
				</tr>
				<tr>
				<td class="form-group">
					<select name="grado" id="grado" class="form-control">
						<option value="0" disabled selected>-- Seleccione una Opción --</option>
						<?php
do {
    ?>
						<option value="<?php echo $grado['Id']; ?>"><?php echo $grado['grado']; ?></option>
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
					<input type="date" class="form-control" name="vigencia" id="vigencia" required>
				</td>
				</tr>
				<tr>
					<th>Area:</th>
				</tr>
				<tr>
				<td class="form-group">
					<select name="departamento" id="departamento" class="form-control">
						<option value="0" disabled selected>-- Seleccione una Opción --</option>
						<?php
do {
    if ($depto['abreviatura'] != null) {
        ?>
								<option value="<?php echo $depto['cve_depto']; ?>"><?php echo $depto['departamento'] . " / " . $depto['abreviatura']; ?></option>
							<?php
} else {
        ?>
								<option value="<?php echo $depto['cve_depto']; ?>"><?php echo $depto['departamento']; ?></option>
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
						<option value="<?php echo $nivel['Id']; ?>"><?php echo $nivel['nivel']; ?></option>
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
					<select name="puesto" id="puesto" class="form-control">
						<option value="0" disabled selected>-- Seleccione una Opción --</option>
						<?php
do {
    ?>
						<option value="<?php echo $puesto['Id']; ?>"><?php echo $puesto['puesto']; ?></option>
						<?php
} while ($puesto = $pto->fetch(PDO::FETCH_ASSOC));
?>
					</select>
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
    $nombre = strtoupper(htmlspecialchars($_POST['nombre']));
    $grado = $_POST['grado'];
    $vigencia = $_POST['vigencia'];
    $area = htmlspecialchars($_POST['departamento']);
    $puesto = htmlspecialchars($_POST['puesto']);
    $nivel = $_POST['nivel'];

    $sql = "SELECT * FROM empleados WHERE nombre = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(array($nombre));
    $checaEmpleado = $stmt->fetch(PDO::FETCH_ASSOC);

    $existe_empleado = $stmt->rowCount();

    if ($existe_empleado > 0) {
        echo '<script type="text/javascript">
					swal({
						position: "top",
				 		text: "Este servidor público ya está registrado!",
				 		confirmButtonColor: "#DD6B55"
			 		});
	    			</script>';
    } else {

        try {
            $sql = "INSERT INTO empleados (nombre, grado, vigencia, departamento, nivel, puesto) values (?,?,?,?,?,?)";
            $stmt = $conexion->prepare($sql);
            $stmt->execute(array($nombre, $grado, $vigencia, $area, $nivel, $puesto));

            echo '<script type="text/javascript">
					swal({
						position: "top",
						text: "Has creado una nueva cedula!",
						confirmButtonColor: "#DD6B55"
					});
					</script>';
        } catch (PDOException $e) {
            echo '<script type="text/javascript">
					swal({
						position: "top",
						text: "Problemas para  realizar el registro!",
						confirmButtonColor: "#DD6B55"
					});
					</script>';
            $e->getMessage();
        }
    }
}
?>