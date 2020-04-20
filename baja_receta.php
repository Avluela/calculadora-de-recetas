<?php
if(isset($_GET["id"])){
	include "connection.php";
	$con  = connect();
	$sql = "delete from receta_ingredientes where id_receta=".$_GET["id"];
	$con->query($sql);
	$sql = "delete from receta where id_receta=".$_GET["id"];
	$con->query($sql);
	header("Location: recetas.php");
}
?>