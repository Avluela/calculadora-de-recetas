<?php
if(!empty($_POST)){
	include "connection.php";

	$con  = connect();
	$sql = "insert into receta (receta,porciones,peso,preparacion,id_categoria,id_nivel) value (\"".$_POST["receta"]."\",\"".$_POST["porciones"]."\",\"".$_POST["peso"]."\",\"".$_POST["preparacion"]."\",".$_POST["categoria"].",".$_POST["nivel"].")";
	$con->query($sql);
	$last_id = $con->insert_id;
	$ingrediente = get_ingredientes();
	
	foreach($ingrediente as $frog){
		if(isset($_POST["ingrediente_".$frog->id_ingrediente])){
		$cantidad = $_POST["cantidad".$frog->id_ingrediente];
		$rendimiento= $_POST["rendimiento".$frog->id_ingrediente];
		$sql = "insert into receta_ingredientes (id_receta,id_ingrediente,cantidad,rendimiento) value (".$last_id.",".$frog->id_ingrediente.",".$cantidad.",".$rendimiento.")";
		$con->query($sql);
		}
	}
	header("Location: alta_receta.php");
}
?>