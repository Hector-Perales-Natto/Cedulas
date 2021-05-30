<?php 
include_once("Connections/cedulas.php");

$cve_usu = $_GET['recordID'];

try {
	$sqlUsu = "SELECT * FROM usuarios WHERE Id = ?";
	$usu = $conexion->prepare($sqlUsu);
	$usu->execute(array($cve_usu));
	$usuario = $usu->fetch(PDO::FETCH_ASSOC);

	$sqlRol = "SELECT * FROM roles";
	$rol = $conexion->prepare($sqlRol);
	$rol->execute();
	$roles = $rol->fetch(PDO::FETCH_ASSOC);		
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
<body>
	<div class="contenido">
		<div class="row justify-content-center">
		<form name="registrar" class="form" method="POST">
			<table class="table table-sm col-2">
				<tr><th>MODIFICA USUARIO</th></tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="clave" style='width: 600px' value="<?php echo str_pad($usuario['Id'], 5, "0", STR_PAD_LEFT); ?>" readonly>
				</td>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="nombre"  placeholder="Nombre" value="<?php echo $usuario['nombre']; ?>" required>
				</td>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php echo $usuario['usuario']; ?>" required>
				</td>
				</tr>
				<tr>
				<td class="form-group">
					<input type="password" class="form-control" name="contraseña" placeholder="Contrase&ntilde;a" value="<?php echo $usuario['sin_cifrar']; ?>" required>
				</td>
				</tr>				
				<tr>
				<td class="form-group">
					<select name="rol" class="form-control">
						<option value="0">-- Seleccione una Opción --</option>
						<?php
						do {
						?>
						<option value="<?php echo $roles['Id']?>"<?php if (!(strcmp($usuario['rol'], $roles['Id']))) {echo "SELECTED";} ?>><?php echo $roles['rol']?></option>
						<?php
						} while ($roles = $rol->fetch(PDO::FETCH_ASSOC));
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
if(isset($_POST['guardar'])) {	
	$nombre = strtoupper(htmlspecialchars($_POST['nombre']));
	$usuario = strtoupper(htmlspecialchars($_POST['usuario']));
	$password = htmlspecialchars($_POST['contraseña']);
	$contraseña = password_hash($password, PASSWORD_DEFAULT);	
	$rol = $_POST['rol'];

	try {		
		$sql_up = "UPDATE usuarios SET nombre = ?, usuario = ?, sin_cifrar = ?, password = ?, rol = ? WHERE Id = ?";
		$stmt = $conexion->prepare($sql_up);
		$stmt = $stmt->execute(array($nombre, $usuario, $password, $contraseña, $rol, $cve_usu));
				
		if($stmt) {
			echo '<script type="text/javascript">
						swal({
							position: "top",
							text: "Usuario modificado exitosamente!",
							confirmButtonColor: "#DD6B55"
						}).then(function() {
							window.location.href = "index.php?pagina=lista_mod_usuario.php";
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
						window.location.href = "index.php?pagina=lista_mod_usuario.php";
					});
					</script>';
		$e->getMessage();
	}		
}
?>