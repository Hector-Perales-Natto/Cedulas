<?php 
include_once("Connections/cedulas.php");

$cve_pto = $_GET['recordID'];

try {
	$sqlPto = "SELECT * FROM puestos WHERE Id = ?";
	$pto = $conexion->prepare($sqlPto);
	$pto->execute(array($cve_pto));
	$puesto = $pto->fetch(PDO::FETCH_ASSOC);
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
		<form name="registrar" class="form" method="POST" style="Width: 1000px;">
			<table class="table">
				<tr><th>BORRA PUESTO</th></tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="clave" id="clave" value="<?php echo str_pad($puesto['Id'], 5, "0", STR_PAD_LEFT); ?>" readonly>
				</td>
				</tr>				
                <tr>
				<td class="form-group">
                    <input type="text" class="form-control" name="puesto" id="puesto" value="<?php echo $puesto['puesto']; ?>" readonly>
				</td>
				</tr>
                <tr>
				<td class="form-group">
					<button type="submit" class="btn btn-primary" style="margin-top: 10px;" name="borrar" id="borrar" value="&rarr;">Borrar</button>
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
    $clave = $_POST['clave'];   

	try {
        $sql_up = "UPDATE puestos SET baja = ? WHERE Id = ?";        
	    $stmt = $conexion->prepare($sql_up);
        $stmt = $stmt->execute(array(1, $clave));        
			
		if($stmt) {
			echo '<script type="text/javascript">
						swal({
							position: "top",
					 		text: "Puesto eliminado exitosamente!",
					 		confirmButtonColor: "#DD6B55"
				 		}).then(function() {
							window.location.href = "index.php?pagina=lista_del_puesto.php";
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
						window.location.href = "index.php?pagina=lista_del_puesto.php";
					});
	    			</script>';
		$e->getMessage();
	}	
}

?>