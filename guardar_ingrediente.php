<?php
if(!empty($_POST)){
	
	$con  = connect();
	$sql = "insert into ingrediente (ingrediente,id_medida,costo_unidad) value (\"".$_POST["nombre"]."\",".$_POST["medida"].",\"".$_POST["costo_unidad"]."\")";
	$con->query($sql);

	$_POST = array();
	
	$cliente=true;
	header("Location: alta_ingrediente.php?varCliente=$cliente");
	exit();
}
?>