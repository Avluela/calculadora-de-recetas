<?php

if(!empty($_POST)){
	include "connection.php";
	$id=$_POST[id];
	
	$con  = connect();
	$sql = "update receta set receta=\"".$_POST["receta"]."\",porciones=\"".$_POST["porciones"]."\",peso=\"".$_POST["peso"]."\",preparacion=\"".$_POST["preparacion"]."\",id_categoria=\"".$_POST["categoria"]."\",id_nivel=\"".$_POST["nivel"]."\" where id_receta=$id";
	$con->query($sql);
	
	$ingrediente = get_ingredientes();

	$sql = "delete from receta_ingredientes where post_id=".$id;
	$con->query($sql);
	
	foreach($ingrediente as $frog){
		if(isset($_POST["ingrediente_".$frog->id_ingrediente])){
		$cantidad = $_POST["cantidad".$frog->id_ingrediente];
		$rendimiento= $_POST["rendimiento".$frog->id_ingrediente];
		$sql = "insert into receta_ingredientes (id_receta,id_ingrediente,cantidad,rendimiento) value (".$id.",".$frog->id_ingrediente.",".$cantidad.",".$rendimiento.")";
		$con->query($sql);
		}
	}
	header("Location: recetas.php");
}
?>
