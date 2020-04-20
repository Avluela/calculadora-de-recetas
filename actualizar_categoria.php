<?php
if(!empty($_POST)){
	include "connection.php";
	$con  = connect();
	$sql = "update categoria set categoria=\"".$_POST["title"]."\" where id_categoria=$_POST[id]";
	$con->query($sql);
	header("Location: categorias.php");
}
?>