<?php
include_once("Connections/cedulas.php");

try {
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
		<form name="registrar" class="form" method="POST">
			<table class="table table-sm col-12">
				<tr><th>ALTA DE USUARIO</th></tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" required name="nombre" placeholder="Nombre del usuario" style='width: 600px'>
				</td>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" required name="usuario" placeholder="Usuario">
				</td>
				</tr>
				<tr>
				<td class="form-group">
					<input type="password" class="form-control" required name="contraseña" placeholder="Contrase&ntilde;a">
				</td>
				</tr>				
				<tr>
				<td class="form-group">
					<select name="rol" class="form-control">
						<option value="0" disabled selected>-- Seleccione una Opción --</option>
						<?php
						do {
						?>
						<option value="<?php echo $roles['Id']; ?>"><?php echo $roles['rol']; ?></option>
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
	$contraseña = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
	$rol = htmlspecialchars($_POST['rol']);

	$sql = "SELECT * FROM usuarios WHERE usuario = ?";
	$stmt = $conexion->prepare($sql);
	$stmt->execute(array($usuario));
	$checaUsuario = $stmt->fetch(PDO::FETCH_ASSOC);

	if($checaUsuario) {
		echo '<script type="text/javascript">
					swal({
						position: "top",
				 		text: "Este usuario ya está registrado!",
				 		confirmButtonColor: "#DD6B55"
			 		}).then(function() {
						window.location.href = "index.php?pagina=regUsuario.php";
					});
	    			</script>';
	} else {		
		try {
			$sql = "INSERT INTO usuarios (nombre, usuario, sin_cifrar, password, rol) values (?,?,?,?,?)";
			$stmt = $conexion->prepare($sql);
			$stmt->execute(array($nombre, $usuario, $password, $contraseña, $rol));
			echo '<script type="text/javascript">
					swal({
						position: "top",
						text: "Ha dado de alta un nuevo usuario exitosamente!",
						confirmButtonColor: "#DD6B55"
					}).then(function() {
						window.location.href = "index.php?pagina=regUsuario.php";
					});
					</script>';
		}catch(PDOException $e) {
			echo '<script type="text/javascript">
					swal({
						position: "top",
						text: "Problemas para realizar el registro!",
						confirmButtonColor: "#DD6B55"
					}).then(function() {
						window.location.href = "index.php?pagina=regUsuario.php";
					});
					</script>';
			$e->getMessage();
		}		
	}
}
?>