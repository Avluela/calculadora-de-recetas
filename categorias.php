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
				<h1>Categorias</h1>
				<table class="table table-striped">
					<th>
						<a href="./alta_categoria.php" class="btn btn-default">Nueva Categoria</a>
					</th>
					<th>
					<div class="text-right">
						<form method="post">
							<input type="text" class="input-sm" placeholder="Categoria..." name="xcategoria"/>
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
						$categoria=$_POST['xcategoria'];
						$where="WHERE categoria LIKE '".$categoria."%'";
					}

//////////////// CONSULTA A LA BASE DE DATOS//////////////////////////////

					$sql = "SELECT * FROM categoria $where order by categoria";
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
							<th>Nombre</th>
							<th></th>
						</thead>
						<?php foreach($data as $d):?>
							<tr>
								<td><?php echo $d->categoria; ?></td>
								<td>
									<a href="./modif_categoria.php?id=<?php echo $d->id_categoria?>" class='btn btn-danger btn-xs'>Modificar</a>
									<a href="./baja_categoria.php?id=<?php echo $d->id_categoria?>" class='btn btn-danger btn-xs'>Eliminar</a>
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