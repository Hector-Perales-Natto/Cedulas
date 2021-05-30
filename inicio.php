<?php
include_once("Connections/cedulas.php");
include("inicio.html");

if(isset($_POST['ingresar'])) {
	$usuario = htmlspecialchars($_POST['usuario']);
	$password = htmlspecialchars($_POST['clave']);
	
	// $contraseñaEncriptada = password_hash($password, PASSWORD_DEFAULT);
	// echo $contraseñaEncriptada;
	// exit;

	try {
		$sql = "SELECT * FROM usuarios WHERE usuario = ? && baja = 0";

		$stmt = $conexion->prepare($sql);
		$stmt->execute(array($usuario));
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC); 

		if(!empty($usuario) && !empty($password)) {
				$contrasenaEnBaseDeDatos = $resultado['password'];				
				
				if(password_verify($password, $contrasenaEnBaseDeDatos)) {
						if ($resultado['activo'] == 0) {		
							
							$_SESSION['USUARIO'] = $resultado['usuario'];							
							$_SESSION['ROL'] = $resultado['rol'];														

							$hoy_e = strftime("%Y-%m-%dT%H:%M:%S",time());
							$claveEmp = $_SESSION['USUARIO'];

							try {
								$sql = "UPDATE usuarios SET entrada = ?, activo = ? WHERE usuario = ?";

								$stmt = $conexion->prepare($sql);
								$stmt->execute(array($hoy_e, 0, $claveEmp));

								echo "<script>
										location.href = 'index.php?pagina=menu.php';
							  		 </script>";													 
							}catch(PDOException $e) {
									$e->getMessage();
							}
						} else {			
									echo '<script type="text/javascript">
									swal({
										position: "top",
										text: "Usuario activo o no cerro el sistema con el boton de salir, póngase en contacto con el administrador del sistema!",
										confirmButtonColor: "#DD6B55"
									}).then(function() {
										window.location.href = "index.php?pagina=inicio.php";
									});
									</script>';
						}						
				} else {			
					echo '<script type="text/javascript">
					swal({
						position: "top",
				 		text: "Autenticación incorrecta!",
				 		confirmButtonColor: "#DD6B55"
					}).then(function() {
						window.location.href = "index.php?pagina=inicio.php";
					});
		    		</script>';
				}					
		} else {			
			echo '<script type="text/javascript">
			swal({
				position: "top",
				text: "Campos de usuario y/o contraseña vacios!",
				confirmButtonColor: "#DD6B55"
			}).then(function() {
				window.location.href = "index.php?pagina=inicio.php";
			});
	    	</script>';
		}				 
	}catch(PDOException $e) {
		echo $e->getMessage();
	}
}
?>