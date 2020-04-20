<?php
if(isset($_GET["id"])){
	include "connection.php";
	$con  = connect();
	$sql = "delete from ingrediente where id_ingrediente=".$_GET["id"];
	$con->query($sql);
	header("Location: ingredientes.php");
}
?>