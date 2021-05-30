<?php
include_once("Connections/cedulas.php");
session_start();

if(isset($_GET['pagina'])) {	
	$pagina = $_GET['pagina'];
} else {	
	$pagina = "inicio.php";
}

if($pagina) {
	include($pagina);
}
?>