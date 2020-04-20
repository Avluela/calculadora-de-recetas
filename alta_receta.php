<?php 
if (isset($_GET['varCliente'])){ 
    if (empty($_POST)){?>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
        <div class="checked-ok">
        <div class="contenido">
            <h5>GUARDADO</h5>
        </div>
        </div>
    <?php
    }
}
?>

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

///////////////////////VARIABLES DE CONTROL/////////////////////////////

$enviado=false;
$vnombre=NULL;
$vmedida=NULL;
$vcosto=NULL;
$vmedida=NULL;
$vvmedida="Medida";

//////////////////////MANTENIMIENTO DE VARIABLES////////////////////////

if (isset($_POST['enviar'])){
    $calculadora=false;
    $enviado=true;
    $vnombre=$_POST['nombre'];
    $vmedida=$_POST['medida'];
    $vcosto=$_POST['costo_unidad'];
    if (($_POST['medida'])!=NULL){
      $m = get_medida($vmedida);
      $vvmedida=$m->medida;
    }
}

if (isset($_POST['calcular'])){
  $vnombre=$_POST['nombre'];
  $vcosto=$_POST['costo_unidad'];
  $vmedida=$_POST['medida'];
  if (($_POST['medida'])!=NULL){
    $m=get_medida($vmedida);
    $vvmedida=$m->medida;
  }
  if ((is_numeric($_POST['bulto'])) and (is_numeric($_POST['precio_bulto']))){
    $vcosto=($_POST['precio_bulto'])/($_POST['bulto']);
  }
}

?>


<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Recetas</h1>
      <h3>Nueva Receta</h3>

      <form method="post" action="./guardar_receta.php">
  
<!-- *************************NOMBRE********************* -->

        <div class="form-group">
          <label for="receta">Nombre</label>
          <input required type="text" id="receta" class="form-control" name="receta" placeholder="Nombre de la Receta">
        </div>
  
<!-- *************************PORCIONES********************* -->

        <div class="form-group">
          <label for="receta">Porciones</label>
          <input required type="integer" id="porciones" class="form-control" name="porciones" placeholder="Porciones que rinde la receta">
        </div>

<!-- *************************PESO********************* -->

        <div class="form-group">
          <label for="receta">Peso</label>
          <input type="integer" id="peso" class="form-control" name="peso" placeholder="Peso total de la receta">
        </div>

<!-- *************************INGREDIENTES********************* -->
  
        <div class="form-group">
          <label for="description">Ingredientes</label>
        
          <?php
            $ingredientes = get_ingredientes();
          ?>
    
          <?php if(count($ingredientes)>0):?>
            <?php foreach($ingredientes as $d):
              $m=get_medida($d->id_medida);?>
              <div class="checkbox">
                <label>
                  <input required type="checkbox" name="ingrediente_<?php echo $d->id_ingrediente; ?>"> <?php echo $d->ingrediente; ?>
                  <input required type="text" id="cantidad" class="form-control" name="cantidad<?php echo $d->id_ingrediente; ?>" placeholder='Cantidad en "<?php echo $m->medida;?>"'>
                  <input required type="text" id="rendimiento" class="form-control" name="rendimiento<?php echo $d->id_ingrediente; ?>" placeholder="Porcentaje de rendimiento del ingrediente para esta receta">
                </label>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>

<!-- *************************NIVEL********************* -->

        <div class="form-group">
          <label for="description">Nivel</label><br>
          <?php
            $nivel = get_niveles();
          ?>
          <?php if(count($nivel)>0):?>
            <select name="nivel" class="btn btn-default" >
          		<option value="">Nivel </option>
      		    <?php foreach($nivel as $d):
                echo '<option value="'.$d->id_nivel.'">'.$d->nivel.'</option>';  
              endforeach; ?>
            </select>
          <?php endif; ?>
        </div>

<!-- *************************CATEGORIA********************* -->

        <div class="form-group">
          <label for="description">Categoría</label><br>
          <?php
            $categoria = get_categorias();
          ?>
          <?php if(count($categoria)>0):?>
            <select name="categoria" class="btn btn-default" >
              <option value="">Categoria </option>
       		    <?php foreach($categoria as $d):
                echo '<option value="'.$d->id_categoria.'">'.$d->categoria.'</option>';
              endforeach; ?>
            </select>
          <?php endif; ?>
        </div>

<!-- *************************PREPARACION********************* -->

        <div class="form-group">
          <label for="Preparacion">Preparación</label>
          <textarea class="form-control" name="preparacion" id="preparacion" placeholder="Describa la preparacion de la receta"></textarea>
        </div>

        <button name="guardar" type="submit" class="btn btn-primary">Agregar</button>
        <a href="./recetas.php" class='btn btn-primary'>Volver</a>
      
      </form>
		</div>
	</div>
</div>


</body>
</html>