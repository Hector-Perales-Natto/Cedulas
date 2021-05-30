<?php
include_once "Connections/cedulas.php";

$cve_emp = $_GET['recordID'];

try {
    $sql = "SELECT e.Id, e.nombre, g.grado, n.nivel, p.puesto, d.departamento, e.vigencia, e.archivo, e.baja, d.abreviatura
	FROM empleados e JOIN grados g
	ON e.grado = g.Id
	JOIN puestos p
	ON e.puesto = p.Id
	JOIN departamentos d
	ON e.departamento = d.cve_depto
	JOIN niveles n
	ON e.nivel = n.Id
	WHERE e.Id = ?";
    $conCed = $conexion->prepare($sql);
    $conCed->execute(array($cve_emp));
    $cedulas = $conCed->fetch(PDO::FETCH_ASSOC);
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
<body>
	<div class="contenido">
		<div class="row justify-content-center">
		<form name="registrar" class="form" method="POST">
			<table class="table table-sm col-2">
				<tr><th>CEDULAS INACTIVAS</th></tr>
				<tr>
					<th>Clave de cedula:</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="clave" style="width: 800px;" value="<?php echo str_pad($cedulas['Id'], 5, "0", STR_PAD_LEFT); ?>" readonly>
				</td>
				</tr>
                <tr>
					<th>Nombre (nombre(s), apellidos paterno y materno):</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="empleado" value="<?php echo $cedulas['nombre']; ?>" readonly>
				</td>
                </tr>
                <tr>
					<th>Grado (academico o social):</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="grado" value="<?php echo $cedulas['grado']; ?>" readonly>
				</td>
				</tr>
				<tr>
					<th>Fecha de vigencia:</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="vigencia" value="<?php echo $cedulas['vigencia']; ?>" readonly>
				</td>
				</tr>
				<tr>
					<th>Area:</th>
				</tr>
				<tr>
				<td class="form-group">
					<?php
if ($cedulas['abreviatura'] != null) {
    ?>
						<input type="text" class="form-control" name="departamento" value="<?php echo $cedulas['departamento'] . " / " . $cedulas['abreviatura']; ?>" readonly>
					<?php
} else {
    ?>
						<input type="text" class="form-control" name="departamento" value="<?php echo $cedulas['departamento']; ?>" readonly>
					<?php
}
?>
				</td>
                </tr>
				<tr>
					<th>Nivel:</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="nivel" value="<?php echo $cedulas['nivel']; ?>" readonly>
				</td>
                </tr>
                <tr>
					<th>Puesto:</th>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="puesto" value="<?php echo $cedulas['puesto']; ?>" readonly>
				</td>
                </tr>
				<tr>
					<th>Estatus:</th>
                </tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="estatus" value="<?php if ($cedulas['baja'] == 0) {echo 'ACTIVA';} else {echo 'INACTIVA';}?>" readonly>
				</td>
				</tr>
				<tr>
				<td class="text-secondary" style="text-align: center; background-color: #2388E5"><span style="color:#FFF">CEDULA FIRMADA EN PDF</span></td>
				</tr>
				<tr>
					<td class="form-group" colspan="2">
						<input type="text" name="archivo" id="archivo" class="form-control" value="<?php echo $cedulas['archivo']; ?>" style="width: 79%; display: inline-block;" readonly>
						<?Php
if ($cedulas['archivo'] == null) {
    ?>
						<a class="btn btn-secondary disabled" name="abrir" id="abrir" href="<?php echo "pdf/" . $cedulas['archivo']; ?>" target="_blank" style="margin-bottom: 7px;" >Abrir Archivo</a>
						<?Php
} else {
    ?>
						<a class="btn btn-secondary" name="abrir" id="abrir" href="<?php echo "pdf/" . $cedulas['archivo']; ?>" target="_blank" style="margin-bottom: 7px;" >Abrir Archivo</a>
						<?Php
}
?>
					</td>
				</tr>
				<tr>
				<td class="form-group">
                    <a name="regresar" id="regresar" class="btn btn-primary" href="index.php?pagina=lista_cedulas_ina.php">Regresar</a>
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