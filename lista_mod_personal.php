<?php
include_once("Connections/cedulas.php");

try {
    $sql = "SELECT e.Id, e.nombre, d.departamento FROM empleados e JOIN departamentos d  ON e.departamento = d.cve_depto WHERE e.baja = 0 ORDER BY e.Id";
    $borraEmp = $conexion->prepare($sql);
    $borraEmp->execute();
    $empleados = $borraEmp->fetch(PDO::FETCH_ASSOC);

    $_GET['pagina'] = isset($_GET['pagina']) ? $_GET['pagina'] : 0 ;

    $empleados_x_pagina = 15;

    $total_empleados_bd = $borraEmp->rowCount();

    $paginas = $total_empleados_bd/$empleados_x_pagina;

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
            <h1>MODIFICA CEDULAS</h1>

            <form method="POST" action="" onSubmit="return validarForm(this)"> 
                <input type="text" class="form-control" placeholder="Buscar por nombre de empleado o departamento" name="palabra" style="width: 90%; display: inline-block; margin-bottom: 10px;"> 
                <button type="submit" class="btn btn-primary" name="buscar" id="buscar" value="&rarr;" style="margin-bottom: 8px;">Buscar</button> 
            </form>

            <?php

            if($_GET['pagina']>$paginas || $_GET['pagina']<=0) {
                echo "<script>location.href = 'lista_mod_personal.php?pagina=1';</script>";
            }
            
            $iniciar = ((int)$_GET['pagina']-1)*$empleados_x_pagina;

            if(isset($_POST['buscar'])) {
                try {
                    $sql_emp = "SELECT e.Id, e.nombre, d.departamento FROM empleados e JOIN departamentos d  ON e.departamento = d.cve_depto WHERE e.baja = 0 && d.departamento like '%".$_POST['palabra']."%' || e.nombre like '%".$_POST['palabra']."%' ORDER BY e.Id LIMIT :iniciar,:ndictamenes";
                    $sentencia_emp = $conexion->prepare($sql_emp);
                    $sentencia_emp->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
                    $sentencia_emp->bindParam(':ndictamenes', $empleados_x_pagina, PDO::PARAM_INT);
                    $sentencia_emp->execute();
                }catch(PDOException $e) {
                    echo $e->getMessage();
                }
            } else {
                try {
                    $sql_emp = "SELECT e.Id, e.nombre, d.departamento FROM empleados e JOIN departamentos d  ON e.departamento = d.cve_depto WHERE e.baja = 0 ORDER BY e.Id LIMIT :iniciar,:ndictamenes";
                    $sentencia_emp = $conexion->prepare($sql_emp);
                    $sentencia_emp->bindParam(':iniciar', $iniciar, PDO::PARAM_INT);
                    $sentencia_emp->bindParam(':ndictamenes', $empleados_x_pagina, PDO::PARAM_INT);
                    $sentencia_emp->execute();
                }catch(PDOException $e) {
                    echo $e->getMessage();
                }
            }

            $resultado_emp = $sentencia_emp->fetchAll();
                        
            ?>

            <table class="table table-striped table-bordered">
                <thead>
                    <tr style="text-align: center;">
                        <th>CLAVE CEDULA</th>
                        <th>NOMBRE</th>
                        <th>DEPARTAMENTO</th>
                    </tr>
                </thead>                
                <?php
                foreach($resultado_emp as $personal):                                          
                ?>     
                    <tr>
                        <td style="text-align: center;  width: 10%;"><a href="modPersonal.php?recordID=<?php echo $personal['Id']; ?>"><?php echo str_pad($personal['Id'], 5, "0", STR_PAD_LEFT); ?></a></td>
                        <td style="text-align: left;"><?php echo $personal['nombre']; ?></td>
                        <td style="text-align: left;"><?php echo $personal['departamento']; ?></td>                           
                    </tr>
                <?php endforeach ?>                    
            </table>                
            

            <nav aria-label="Page navigatíon example">
                <ul class="pagination">
                    <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled' : '' ?>">
                        
                        <a class="page-link" href="lista_mod_personal.php?pagina=<?php echo (int)$_GET['pagina']-1; ?>">  Anterior</a>

                    </li>

                    <?php for($i=0;$i<$paginas;$i++): ?>
                        <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
                            <a class="page-link" href="lista_mod_personal.php?pagina=<?php echo $i+1; ?>">
                                <?php echo $i+1; ?>
                            </a>
                        </li>
                    <?php endfor ?>

                    <li class="page-item <?php echo $_GET['pagina']>=$paginas ? 'disabled' : '' ?>">
                        <a class="page-link" href="lista_mod_personal.php?pagina=<?php echo (int)$_GET['pagina']+1; ?>">Siguiente</a>
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