<?php 
include_once("Connections/cedulas.php");

$cve_usu = $_GET['recordID'];

try {
	$sqlUsu = "SELECT * FROM usuarios WHERE Id = ?";
	$usu = $conexion->prepare($sqlUsu);
	$usu->execute(array($cve_usu));
	$usuario = $usu->fetch(PDO::FETCH_ASSOC);	
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
    <script src="js/sweetalert2.min.js"></script>

    <style>
		body {
            background-color: #eef5f9;
		}
		
    	td {
    		width: 300px;
    	}
	</style>
</head>
<body>
	<div class="contenido">
		<div class="row justify-content-center">
		<form name="registrar" class="form" method="POST">
			<table class="table">
				<tr><th>BORRA USUARIO</th></tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="clave" id="clave" style="width: 600px;" value="<?php echo str_pad($usuario['Id'], 5, "0", STR_PAD_LEFT); ?>" readonly>
				</td>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $usuario['nombre']; ?>" readonly>
				</td>
				</tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $usuario['usuario']; ?>" readonly>
				</td>
				</tr>				
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="rol" value="<?php if($usuario['rol']==1){ echo 'Administrador';}else{ echo 'Capturista';} ?>" readonly>
				</td>
				</tr>												
				<tr>
				<td class="form-group">
					<button type="submit" class="btn btn-primary" name="borrar" id="borrar" value="&rarr;">Borrar</button>
				</td>
				</tr>	
			</table>		
		</form>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">  	
    </script>
</body>
</html>
<?php 
if(isset($_POST['borrar'])) {
	$sql_up = "UPDATE usuarios SET baja = ? WHERE Id = ?";
	$stmt = $conexion->prepare($sql_up);	

	try {
		$stmt = $stmt->execute(array(1, $cve_usu));
			
		if($stmt) {
			echo '<script type="text/javascript">
						swal({
							position: "top",
					 		text: "Usuario eliminado exitosamente!",
					 		confirmButtonColor: "#DD6B55"
				 		}).then(function() {
							window.location.href = "index.php?pagina=lista_del_usuario.php";
						});
		    			</script>';
	    }			
	}catch(PDOException $e) {
		echo '<script type="text/javascript">
					swal({
						position: "top",
				 		text: "Problemas para realizar la eliminación!",
				 		confirmButtonColor: "#DD6B55"
			 		}).then(function() {
						window.location.href = "index.php?pagina=lista_del_usuario.php";
					});
	    			</script>';
		$e->getMessage();
	}	
}

?>