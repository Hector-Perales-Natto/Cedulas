<?php 
include_once("Connections/cedulas.php");

$cve_fac = $_GET['recordID'];

try {
	$sqlfac = "SELECT * FROM facultades WHERE clave = ?";
	$fac = $conexion->prepare($sqlfac);
	$fac->execute(array($cve_fac));
	$facultad = $fac->fetch(PDO::FETCH_ASSOC);	
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
				<tr><th>BORRA FACULTADES</th></tr>
				<tr>
				<td class="form-group">
					<input type="text" class="form-control" name="clave" value="<?php echo $facultad['clave']; ?>" readonly>
				</td>
				</tr>
				<tr>
				<td class="form-group">
                    <textarea name="facultad" cols="80" rows="5" readonly><?php echo $facultad['facultad']; ?></textarea>
				</td>
                </tr>
                <tr>
				<td class="form-group">
                    <textarea name="referencia" cols="80" rows="5" readonly><?php echo $facultad['referencia']; ?></textarea>
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
    $clave = htmlspecialchars($_POST['clave']);   

	try {
        $sql_up = "UPDATE facultades SET baja = ? WHERE clave = ?";        
	    $stmt = $conexion->prepare($sql_up);
        $stmt = $stmt->execute(array(1, $clave));        
			
		if($stmt) {
			echo '<script type="text/javascript">
						swal({
							position: "top",
					 		text: "Facultad eliminada exitosamente!",
					 		confirmButtonColor: "#DD6B55"
				 		}).then(function() {
							window.location.href = "index.php?pagina=lista_del_fac.php";
						});
		    			</script>';
	    }			
	}catch(PDOException $e) {
		echo '<script type="text/javascript">
					swal({
						position: "top",
				 		text: "Problemas para borrar la facultad!",
				 		confirmButtonColor: "#DD6B55"
			 		}).then(function() {
						window.location.href = "index.php?pagina=lista_del_fac.php";
					});
	    			</script>';
		$e->getMessage();
	}	
}

?>