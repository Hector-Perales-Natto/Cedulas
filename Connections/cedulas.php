 <?php
define("HOST", "localhost");
define("BD", "cedulas");
define("USUARIO", "root");
define("CONTRASENA", "root");

try {
    $conexion = new PDO("mysql:host=" . HOST . "; dbname=" . BD . ";", USUARIO, CONTRASENA, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
    echo "<script>alert('No se pudo realizar la conexión a la base de datos, consulte a su administrador de sistemas');</script>";
}
?>