<?php
include_once("Connections/cedulas.php");

try {
    $sql = "SELECT * FROM usuarios WHERE baja = 0";
    $borraUsuario = $conexion->prepare($sql);
    $borraUsuario->execute();
    $resultado = $borraUsuario->fetch(PDO::FETCH_ASSOC);

    $_GET['pagina'] = isset($_GET['pagina']) ? $_GET['pagina'] : 0 ;

    $usuarios_x_pagina = 5;

    $total_usuarios_bd = $borraUsuario->rowCount();

    $paginas = $total_usuarios_bd/$usuarios_x_pagina;

    $paginas = ceil($paginas);                        
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
    <link rel="stylesheet" type="text/css" href="css/acomoda.css">
    <style>
        body {
            background-color: #eef5f9;
        }
    </style>
</head>
<body>
	<div class="container  my-5">
            <h1>BAJA DE USUARIO</h1>

            <form method="POST" action="" onSubmit="return validarForm(this)"> 
                <input type="text" class="form-control" placeholder="Buscar usuario" name="palabra" style="width: 90%; display: inline-block; margin-bottom: 10px;"> 
                <button type="submit" class="btn btn-primary" name="buscar" id="buscar" value="&rarr;" style="margin-bottom: 8px;">Buscar</button> 
            </form>

            <?php

            if($_GET['pagina']>$paginas || $_GET['pagina']<=0) {
                echo "<script>location.href = 'lista_del_usuario.php?pagina=1';</script>";
            }
            
            $iniciar = ((int)$_GET['pagina']-1)*$usuarios_x_pagina;

            if(isset($_POST['buscar'])) {
                try {
                    $sql_usuario = "SELECT * FROM usuarios WHERE baja = 0 AND nombre like '%".$_POST['palabra']."%' LIMIT :iniciar,:ndictamenes";
                    $sentencia_usuario = $conexion->prepare($sql_usuario);
                    $sentencia_usuario->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
                    $sentencia_usuario->bindParam(':ndictamenes', $usuarios_x_pagina, PDO::PARAM_INT);
                    $sentencia_usuario->execute();
                }catch(PDOException $e) {
                    echo $e->getMessage();
                }
            } else {
                try {
                    $sql_usuario = "SELECT * FROM usuarios WHERE baja = 0 LIMIT :iniciar,:ndictamenes";
                    $sentencia_usuario = $conexion->prepare($sql_usuario);
                    $sentencia_usuario->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
                    $sentencia_usuario->bindParam(':ndictamenes', $usuarios_x_pagina, PDO::PARAM_INT);
                    $sentencia_usuario->execute();
                }catch(PDOException $e) {
                    echo $e->getMessage();
                }
            }

            $resultado_usuario = $sentencia_usuario->fetchAll();
                        
            ?>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>CLAVE USUARIO</th>
                        <th>NOMBRE</th>
                        <th>ROL</th>
                    </tr>
                </thead>                
                <?php
                foreach($resultado_usuario as $usuarios): 
                    $sqlRol = "SELECT * FROM roles WHERE id = ?";
                    $rol = $conexion->prepare($sqlRol);
                    $rol->execute(array($usuarios['rol']));
                    $roles = $rol->fetch(PDO::FETCH_ASSOC);                      
                ?>     
                    <tr>
                        <td style="text-align: center;  width: 33.3%;"><a href="bajUsuario.php?recordID=<?php echo $usuarios['Id']; ?>"><?php echo str_pad($usuarios['Id'], 5, "0", STR_PAD_LEFT); ?></a></td>
                        <td style="text-align: left;"><?php echo $usuarios['nombre']; ?></td>                        
                        <td style="text-align: left;"><?php echo $roles['rol']; ?></td>                           
                    </tr>
                <?php endforeach ?>                    
            </table>                
            

            <nav aria-label="Page navigatíon example">
                <ul class="pagination">
                    <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled' : '' ?>">
                        
                        <a class="page-link" href="lista_del_usuario.php?pagina=<?php echo (int)$_GET['pagina']-1; ?>">  Anterior</a>

                    </li>

                    <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                            <a class="page-link" href="lista_del_usuario.php?pagina=<?php echo $i+1; ?>">
                                <?php echo $i+1; ?>
                            </a>
                        </li>
                    <?php endfor ?>

                    <li class="page-item <?php echo $_GET['pagina']>=$paginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="lista_del_usuario.php?pagina=<?php echo (int)$_GET['pagina']+1; ?>">Siguiente</a>
                    </li>
                </ul>
            </nav>    
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        
        <script type="text/javascript">
            function validarForm(formulario) 
            {
                if(formulario.palabra.value.length==0) 
                { //¿Tiene 0 caracteres?
                    formulario.palabra.focus();  // Damos el foco al control
                    alert('Debes rellenar este campo'); //Mostramos el mensaje
                    return false; 
                } //devolvemos el foco  
                return true; //Si ha llegado hasta aquí, es que todo es correcto 
            }   
        </script>
</body>
</html>