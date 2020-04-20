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
        <h3>Modificar Receta</h3>

        <form method="post" action="./actualizar_receta.php">
     
          <input type="hidden" name="id" value="<?php echo $post->id_receta; ?>">

<!-- *************************NOMBRE********************* -->

          <div class="form-group">
            <label for="receta">Nombre</label>
            <input type="text" id="receta" class="form-control" value="<?php echo $post->receta; ?>" name="receta" placeholder="Nombre de la Receta">
          </div>

<!-- *************************PORCIONES********************* -->

          <div class="form-group">
            <label for="receta">Porciones</label>
            <input type="integer" id="porciones" class="form-control" value="<?php echo $post->porciones; ?>" name="porciones" placeholder="Porciones que rinde la receta">
          </div>

<!-- *************************PESO********************* -->

          <div class="form-group">
            <label for="receta">Peso</label>
            <input type="integer" id="peso" class="form-control" value="<?php echo $post->peso; ?>" name="peso" placeholder="Peso total de la receta">
          </div>

<!-- *************************INGREDIENTES********************* --> 

          <div class="form-group">
            <label for="description">Ingredientes</label>
            <?php
              $ingredientes = get_ingredientes();
            ?>
            <?php if(count($ingredientes)>0):?>
              <?php foreach($ingredientes as $d):
                $encontrado = false;
                foreach($post_ingredientes as $pc){
                  if($pc->id_ingrediente==$d->id_ingrediente){
                    $g=$pc;
                    $encontrado = true;
                  break;
                  }
                }
              ?>
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="ingrediente_<?php echo $d->id_ingrediente; ?>"<?php if($encontrado){ echo "checked"; }?>> <?php echo $d->ingrediente; ?>
                    <input type="text" id="cantidad" class="form-control" <?php if ($pc->id_ingrediente==$d->id_ingrediente){echo "value=".$g->cantidad;} ?> name="cantidad<?php echo $d->id_ingrediente; ?>" placeholder="Cantidad">
                    <input type="text" id="rendimiento" class="form-control" <?php if ($pc->id_ingrediente==$d->id_ingrediente){echo "value=".$g->rendimiento;} ?> name="rendimiento<?php echo $d->id_ingrediente; ?>" placeholder="Porcentaje de rendimiento del ingrediente para esta receta">
                  </label>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>

<!-- *************************NIVEL********************* -->
    
          <div class="form-group">
            <label for="description">Nivel</label><br>
            <?php
              $n = get_nivel($post->id_nivel);
              $nivel = get_niveles();
            ?>
            <?php if(count($nivel)>0):?>
              <select name="nivel">
                <option value="<?php echo $post->id_nivel; ?>"><?php echo $n->nivel; ?></option>
                <?php foreach ($nivel as $d):
		  		  		  echo '<option value="'.$d->id_nivel.'">'.$d->nivel.'</option>';
  			  		  endforeach; ?>
	  		      </select>
            <?php endif; ?>
          </div>

<!-- *************************CATEGORIA********************* -->  

          <div class="form-group">
            <label for="description">Categoría</label><br>
            <?php
              $c = get_categoria($post->id_categoria);
              $categoria = get_categorias();
            ?>
            <?php if(count($categoria)>0):?>
              <select name="categoria">
                <option value="<?php echo $post->id_categoria; ?>"><?php echo $c->categoria; ?></option>
                <?php foreach ($categoria as $d):
		  		  		  echo '<option value="'.$d->id_categoria.'">'.$d->categoria.'</option>';
  			  		  endforeach; ?>
	  		      </select>
            <?php endif; ?>
          </div>

<!-- *************************PREPARACION********************* -->

          <div class="form-group">
            <label for="Preparacion">Preparación</label>
            <textarea class="form-control" name="preparacion" id="preparacion" value="<?php echo $post->receta; ?>" placeholder="Describa la preparacion de la receta"><?php echo $post->preparacion; ?></textarea>
          </div>

          <button type="submit" class="btn btn-success">Actualizar</button>
          <a href="./recetas.php" class='btn btn-primary'>Cancelar</a>
        </form>
  		</div>
	  </div>
  </div>

</body>
</html>