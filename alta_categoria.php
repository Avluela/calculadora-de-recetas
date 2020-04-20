<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Calculadora de recetas</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>
<body>

<?php include "navbar.php";?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Categorias</h1>

			<form method="post" action="">
				<div class="form-group">
				    <label for="title">Nombre</label>
				    <input required type="text" id="title" class="form-control" name="title" placeholder="Nombre de la Categoria">
				</div>
				<button name="categorias" type="submit" class="btn btn-primary">Agregar</button>
				<a href="./categorias.php" class='btn btn-primary'>Volver</a>
			</form>

		</div>
	</div>
</div>

<!--***************************Leyenda de checked*************************-->
			
<?php if (isset($_POST['categorias'])){ ?>
	<div class="checked-ok">
		<div class="contenido">
			<h5>GUARDADO</h5>
		</div>
	</div>
	<?php
//////////////////////////////////CONSULTA SQL////////////////////////////////
	if(!empty($_POST)){
		include "connection.php";
		$con  = connect();
		$sql = "insert into categoria (categoria) value (\"".$_POST["title"]."\")";
		$con->query($sql);
	}
}?>

<!--*******************************HASTA ACÁ******************************-->

</body>
</html>