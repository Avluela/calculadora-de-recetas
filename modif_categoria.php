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

<?php
  $post = get_categoria($_GET["id"]);
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1><?php echo $post->categoria; ?></h1>
      		<h3>Modificar categoria</h3>

<form method="post" action="./actualizar_categoria.php">
<input type="hidden" name="id" value="<?php echo $post->id_categoria; ?>">
  <div class="form-group">
    <label for="title">Nombre</label>
    <input type="text" id="title" class="form-control" value="<?php echo $post->categoria; ?>" name="title" placeholder="Nombre de la Categoría">
  </div>

  <button type="submit" class="btn btn-success">Actualizar</button>
</form>

		</div>
	</div>
</div>


</body>
</html>