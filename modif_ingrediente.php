<!DOCTYPE html>
<html>

<head>
	<title>Calculadora de Recetas</title>
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>

<body>

<?php 
include "navbar.php"; 
include "connection.php";
?>

<?php
  $post = get_ingrediente($_GET["id"]);
  $cost="$post->costo_unidad";
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1><?php echo $post->ingrediente; ?></h1>
      <h3>Modificar ingrediente</h3>

      <table class="table table-responsive">
  <!--*****************************************COLUMNA 1************************************************************-->
      <th>
      <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $post->id_ingrediente; ?>">
 
<!-- **************************************NOMBRE************************************ -->

        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input required type="text" id="nombre" class="form-control" value="<?php echo $post->ingrediente; ?>" name="nombre" placeholder="Nombre del ingrediente">
        </div>

<!-- **************************************MEDIDA************************************ -->

        <div class="form-group">
          <?php
            $m = get_medida($post->id_medida);
            $medida = get_medidas();
          ?>
          <?php if(count($medida)>0):?>
            <select required type="text" name="medida" class="btn btn-default">
              <option value="<?php echo $post->id_medida; ?>"><?php echo $m->medida; ?></option>
              <?php foreach ($medida as $d):
		  		  		echo '<option value="'.$d->id_medida.'">'.$d->medida.'</option>';
  			  		endforeach; ?>
	  		    </select>
          <?php endif; ?>
        </div>
<!-- **************************************COSTO UNIDAD**************************************** -->
        <?php
          if (isset($_POST['calcular']))
          {
            if (($_POST['precio_bulto']>0) and ($_POST['bulto']>0))
	          {
              $cost=($_POST['precio_bulto']/$_POST['bulto']);
            }
          }
        ?>
        
        <div class="form-group">
          <label for="description">Costo por unidad</label>
          <input required type="text" id="costo_unidad" class="form-control" value="<?php echo $cost; ?>" name="costo_unidad" placeholder="En caso de ingredientes que se coticen por peso en kg poner el precio unitario del gramo, de los que por litros poner el precio por mililitro, etc.  ">
        </div>

        <button name="guardar" type="submit" class="btn btn-success">Actualizar</button>
      </form>
  </th>

<!--*****************************************COLUMNA 2***********************************************************-->
  
  <th>
    <div class="text-right">
      <label for="title">Podés calcular el precio por unidad acá</label>
    </div>
    <form method="post">
			
      <div class="text-right">
        <br>
        <label for="description">Bulto</label>
        <br>
        <input type="text" class="input-sm" placeholder="Bulto..." name="bulto"/>
        <br><br>
        <label for="description">Precio por bulto</label>
        <br>
        <input type="text" class="input-sm" placeholder="Precio por bulto..." name="precio_bulto"/>
			  <br><br>
        <button name="calcular" type="submit" class="btn btn-default">Calcular</button>
      </div>
    </form>
  </th>

  </table>

  <?php
///////////////////////////////VALIDACION//////////////////////////////////

if (isset($_POST['guardar'])){
  if (!is_numeric($_POST['costo_unidad'])){
    echo "Por favor ingrese costo por unidad valido";
  }
  else {
    include "actualizar_ingrediente.php";
  }
}
?>

		</div>
	</div>
</div>

</body>
</html>