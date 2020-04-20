<?php
if(!empty($_POST)){
	
	$con  = connect();
	$sql = "update ingrediente set ingrediente=\"".$_POST["nombre"]."\",id_medida=\"".$_POST["medida"]."\",costo_unidad=\"".$_POST["costo_unidad"]."\" where id_ingrediente=$_POST[id]";
	$con->query($sql);
	
	$actual=true;
	header("Location: ingredientes.php?varActual=$actual");
	exit();
}
?>