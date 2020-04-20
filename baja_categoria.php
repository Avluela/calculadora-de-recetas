<?php
if(isset($_GET["id"])){
	include "connection.php";
	$con  = connect();
	$sql = "delete from categoria where id_categoria=".$_GET["id"];
	$con->query($sql);
	header("Location: categorias.php");
}
?>