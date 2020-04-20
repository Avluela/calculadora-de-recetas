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
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
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
			<h1>Ingrediente</h1>

<table class="table table-responsive">

<!--*********************COLUMNA 1*****************************-->
<th>
<form method="post" action="">

<!--*********************NOMBRE********************************-->
  <div class="form-group">
    <label for="title">Nombre</label>
    <input name="nombre" type="text" id="nombre" class="form-control" value="<?php echo $vnombre; ?>" placeholder="Nombre del ingrediente">
  </div>

<!--*********************MEDIDA********************************-->
  <div class="form-group">
    <label for="description">Medida</label><br>
    <?php
      $medida = get_medidas();
      if(count($medida)>0):?>
      <select type="text" name="medida" class="btn btn-default">
      <option value="<?php echo $vmedida; ?>"><?php echo $vvmedida;?></option>
		  <?php foreach($medida as $d):
        echo '<option value="'.$d->id_medida.'">'.$d->medida.'</option>';
      endforeach; ?>
      </select>
      <?php endif; ?>
      </div>

<!--*******************COSTO POR UNIDAD************************-->
          <div class="form-group">
            <label for="description">Costo por unidad</label>
        	  <input type="text" id="costo_unidad" class="form-control" name="costo_unidad" value="<?php echo $vcosto; ?>" placeholder="g, ml, unidad...">
          </div>

<!--*******************BOTONES***********************************-->

          <button name="enviar" type="submit" class="btn btn-primary">Agregar</button>
          <a href="./ingredientes.php" class='btn btn-primary'>Volver</a>

          </th>
<!--********************COLUMNA 2********************************-->

        <th>
        <div class="text-right">
              <label for="title">Podés calcular el precio por unidad acá</label>
            </div>
            
			        <div class="text-right text-muted">
                <input type="hidden" name="calculadora" value=true/>
                <br>
                <label for="description">Cantidad comprada</label>
                <br>
                <input type="text" class="input-sm" placeholder="En g, ml, unidades..." name="bulto"/>
                <br><br>
                <label for="description">Precio</label>
                <br>
                <input type="text" class="input-sm" name="precio_bulto"/>
        			  <br><br>
                <button name="calcular" type="submit" class="btn btn-default">Calcular</button>
              </div>
        </form>
      </table>
		</div>
	</div>
</div>

<?php
///////////////////////////////VALIDACION//////////////////////////////////

if ($enviado==true){

  if ($vnombre==NULL){
    echo "Por favor ingrese el nombre <br>";
    $enviado=false;
  }
  if ($vmedida==NULL){
    echo "Por favor seleccione una medida <br>";
    $enviado=false;
  }
  if ($vcosto==NULL){
    echo "Por favor ingrese costo por unidad <br>";
    $enviado=false;
  }
  elseif (!is_numeric($vcosto)){
    $enviado=false;
    echo "Por favor ingrese costo por unidad valido";
  }

}

if (($enviado==true) and ($calculadora==false)){
  include "guardar_ingrediente.php";
}
?>


</body>
</html>