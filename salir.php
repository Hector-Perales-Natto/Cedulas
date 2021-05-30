<?php
	include_once("Connections/cedulas.php");	

	$hoy_s = strftime("%Y-%m-%dT%H:%M:%S",time());
	$claveEmp = $_SESSION['USUARIO'];	
	
	try {
			$sql = "UPDATE usuarios SET salida = ?, activo = ? WHERE usuario = ?";
	
			$stmt = $conexion->prepare($sql);
			$stmt->execute(array($hoy_s, 0, $claveEmp));			
			
			unset($_SESSION['USUARIO']);			
			unset($_SESSION['ROL']);
	
			session_destroy();
	
			$conexion = null;
	
			echo "<script>location.href='".$_SERVER['PHP_SELF']."'</script>";
					 
	}catch(PDOException $e) {
			echo $e->getMessage();
	}
?>
