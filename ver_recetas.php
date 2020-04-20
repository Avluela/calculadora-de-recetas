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
  $post = get_receta($_GET["id"]);
  $post_ingredientes = get_receta_ingredientes($_GET["id"]);
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1><?php echo $post->receta; ?></h1>
			<h4>Ingredientes</h4>
			<h5>(Para <?php echo $post->porciones; ?> porciones)</h5>
			<br>
			
		</div>
		<div class="container">
			<?php
      			$ingredientes = get_ingredientes();
    		?>
    		<?php if(count($ingredientes)>0):?>
 		    <?php foreach($ingredientes as $d):
       			foreach($post_ingredientes as $pc){
           			if($pc->id_ingrediente==$d->id_ingrediente){
           				$g=$pc;
						   echo $g->cantidad." ".$d->ingrediente;
						   echo "<br>";
           			break;
           			}
       			}
       		?> 
      		<?php endforeach; ?>
    		<?php endif; ?>
		</div>
		<?php
			$categoria = get_categoria($_GET["id"]);
			$nivel = get_nivel($_GET["id"]);
    	?>
		<div class="col-md-12">
			<h4>Preparación</h4>
			<h5>(Para <?php echo $post->porciones; ?> porciones)</h5>
			<br>
			<h5><?php echo $post->preparacion; ?><br></h5>
			<a href="./modif_receta.php?id=<?php echo $post->id_receta?>" class='btn btn-primary'>Modificar</a>
			<a href="./baja_receta.php?id=<?php echo $post->id_receta?>" class='btn btn-primary'>Eliminar</a>
			<a href="./recetas.php" class='btn btn-primary'>Volver</a>
		</div>
	</div>
</div>



</body>
</html>