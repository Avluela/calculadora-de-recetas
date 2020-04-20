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
$ingredientes = get_ingredientes();
$categorias = get_categorias();
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Recetas</h1>
			<table class="table table-striped">
				<th>
					<a href="./alta_receta.php" class="btn btn-default">Nueva Receta</a> <!--botón para cargar una nueva receta-->
				</th>
				<th>
			
    <!--*************************************************LAS OPCIONES PARA FILTRAR*********************************************************-->
				
				<div class="text-right text-muted">
					<form method="post">
						<input type="text" class="input-sm" placeholder="Receta..." name="xreceta"/>
											
						<select class="input-sm" name="xingrediente">
							<option value="">Ingrediente </option>
							<?php foreach ($ingredientes as $i):
									echo '<option value="'.$i->id_ingrediente.'">'.$i->ingrediente.'</option>';
							endforeach; ?>
						</select>

						<select class="input-sm" name="xcategoria">
							<option value="">Categoria </option>
							<?php foreach($categorias as $c):
								echo '<option value="'.$c->id_categoria.'">'.$c->categoria.'</option>';
							endforeach;?>
						</select>

						<button name="buscar" type="submit" class="btn btn-default">Buscar</button>

					</form>
				</div>
				</th>
			</table>
<?php

$con = connect();
$where="";
$join=""; //variable de consulta

////////////////////// BOTON BUSCAR //////////////////////////////////////

if (isset($_POST['buscar']))
{
	//////////////////VARIABLES DE CONSULTA/////////////////////////////
		$rec=$_POST['xreceta'];
		$ing=$_POST['xingrediente'];
		$cat=$_POST['xcategoria'];

	$where="WHERE receta.receta LIKE '".$rec."%' "; //le asignamos el valor de la receta por defecto, porque aunque esté vacío no interfiere con el filtro y es más facil formar la sentencia de esta manera"
	
	if ($ing>0)
	{
		$join="INNER JOIN (receta_ingredientes) ON (receta.id_receta=receta_ingredientes.id_receta)"; //para filtrar por ingrediente es necesario traer y unir la tabla receta_ingredientes, pero solo es¿n este caso, si se trae la tabla en los otros casos y el valor de filtro de ingrediente es nulo genera problemas (trae archivos repetidos) 
		
		$where="".$where." AND receta_ingredientes.id_ingrediente='".$ing."'"; //se concatena a la cadena formada antes
	}

	if ($cat>0)
	{
		$where="".$where." AND receta.id_categoria='".$cat."'";//se concatena a la cadena formada antes
	}
}

//////////////// CONSULTA A LA BASE DE DATOS//////////////////////////////

$sql = "SELECT * FROM receta $join
		$where order by receta";  

$query  =$con->query($sql);
$data =  array();
if($query){
	while($r = $query->fetch_object()){
		$data[] = $r;
	}
}
?>

<?php if(count($data)>0):?> <!--si la busqueda arrojó algún resultado-->
	<table class="table table-bordered">
		<thead>
			<th>Titulo</th>
			<th>Porciones</th>
			<th>Peso</th>
			<th>Preparación</th>
			<th>Ingredientes</th>
			<th>Categoria</th>
			<th></th>
		</thead>
		<?php foreach($data as $d):?>  <!--Con el foreach se recorre el array de 1 en 1-->
		<tr>
			<td><?php echo $d->receta; ?></td>
			<td><?php echo $d->porciones; ?></td>
			<td><?php echo $d->peso;?><a> gr</a> </td>
			<td><a href="./ver_recetas.php?id=<?php echo $d->id_receta?>" class='btn btn-warning btn-xs'>Leer Receta completa</a></td>
			<td>
				<?php
				$pcats = get_receta_ingredientes($d->id_receta); //se almacena en $pcats todos los registros de recta_ingredientes que coincidan con el id_receta del registro que se está leyendo 
				if(count($pcats)>0){
					foreach($pcats as $pc){  //se recorren uno por uno los archivos traidos
						$c = get_ingrediente($pc->id_ingrediente); //se almacena en $c el registro de la tabla ingrediente que coincida
						echo "<span class='badge'>";
						echo $c->ingrediente; 
						echo "</span> ";
					}
				}
				?>
				</td>
			<td>
			<?php 
			$c = get_categoria($d->id_categoria); //se almacena en $c el registro de la tabla categoria que coincida con el id_categoria guarrdado en el resgistro de la tabla receta
			echo $c->categoria; 
			?>
			</td>
			<td>
				<a href="./modif_receta.php?id=<?php echo $d->id_receta?>" class='btn btn-warning btn-xs'>Modificar</a> <!--son links con el aspecto de botones unicamente-->
				<a href="./baja_receta.php?id=<?php echo $d->id_receta?>" class='btn btn-danger btn-xs'>Eliminar</a>
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