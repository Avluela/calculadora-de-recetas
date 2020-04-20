<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Calculadora de recetas</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php 
include "navbar.php"; 
include "connection.php";
 ?>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Ingredientes</h1>
			<table class="table table-striped">
				<th>
					<a href="./alta_ingrediente.php" class="btn btn-default">Nuevo ingrediente</a>
				</th>
				<th>
				<div class="text-right text-muted">
					<form method="post">
						<input type="text" class="input-sm" placeholder="Ingrediente..." name="xingrediente"/>
						<button name="buscar" type="submit" class="btn btn-default">Buscar</button>
					</form>
				</div>
				</th>
			</table>
<?php

$con = connect();

$where=""; //variable de consulta

////////////////////// BOTON BUSCAR //////////////////////////////////////

if (isset($_POST['buscar']))
{
		$ingrediente=$_POST['xingrediente'];
		$where="WHERE ingrediente LIKE '".$ingrediente."%'";
}

//////////////// CONSULTA A LA BASE DE DATOS//////////////////////////////

$sql = "SELECT * FROM ingrediente $where order by ingrediente";
$query  =$con->query($sql);
$data =  array();
if($query){
	while($r = $query->fetch_object()){
		$data[] = $r;
	}
}
?>
<?php if(count($data)>0):?>
	<table class="table table-bordered">
		<thead>
			<th>Ingrediente</th>
			<th>Costo unidad</th>
			<th>Medida</th>
			<th></th>
		</thead>
		<?php foreach($data as $d):?>
		<tr>
			<td><?php echo $d->ingrediente; ?></td>
			<td><?php echo $d->costo_unidad; ?></td>
			<td><?php 
			$c = get_medida($d->id_medida);
			echo $c->medida; 
			?></td>
			<td>
				<a href="./modif_ingrediente.php?id=<?php echo $d->id_ingrediente?>" class='btn btn-danger btn-xs'>Modificar</a>
				<a href="./baja_ingrediente.php?id=<?php echo $d->id_ingrediente?>" class='btn btn-danger btn-xs'>Eliminar</a>
			</td>
		</tr>

		<?php endforeach; ?>
	</table>

<?php else:?>
	<p class="alert alert-warning">No hay datos</p>
<?php endif; ?>

		</div>
	</div>
</div>


</body>
</html>