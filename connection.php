<?php

function connect(){
	return new mysqli("localhost","root","","calculadora_recetas"); //("dondesealmacena","usuario","contraña","nombre de la BD")
}

function get_ingredientes(){
	$con = connect();
	$sql = "select * from ingrediente";
	$query  =$con->query($sql);
	$data =  array();
	if($query){
		while($r = $query->fetch_object()){
			$data[] = $r;
		}
	}
	return $data;
}

function get_receta_ingredientes($id){
	$con = connect();
	$sql = "select * from receta_ingredientes where id_receta=".$id;
	$query  =$con->query($sql);
	$data =  array();
	if($query){
		while($r = $query->fetch_object()){
			$data[] = $r;
		}
	}
	return $data;
}

function get_ingrediente($id){
	$con = connect();
	$sql = "select * from ingrediente where id_ingrediente=".$id;
	$query  =$con->query($sql);
	$data =  null;
	if($query){
		while($r = $query->fetch_object()){
			$data = $r;
			break;
		}
	}
	return $data;
}

function get_receta($id){
	$con = connect();
	$sql = "select * from receta where id_receta=".$id;
	$query  =$con->query($sql);
	$data =  null;
	if($query){
		while($r = $query->fetch_object()){
			$data = $r;
			break;
		}
	}
	return $data;
}

function get_medida($id){
	$con = connect();
	$sql = "select * from medida where id_medida=".$id;
	$query  =$con->query($sql);
	$data =  null;
	if($query){
		while($r = $query->fetch_object()){
			$data = $r;
			break;
		}
	}
	return $data;
}

function get_medidas(){
	$con = connect();
	$sql = "select * from medida";
	$query  =$con->query($sql);
	$data =  array();
	if($query){
		while($r = $query->fetch_object()){
			$data[] = $r;
		}
	}
	return $data;
}

function get_categoria($id){
	$con = connect();
	$sql = "select * from categoria where id_categoria=".$id;
	$query  =$con->query($sql);
	$data =  null;
	if($query){
		while($r = $query->fetch_object()){
			$data = $r;
			break;
		}
	}
	return $data;
}

function get_categorias(){
	$con = connect();
	$sql = "select * from categoria";
	$query  =$con->query($sql);
	$data =  array();
	if($query){
		while($r = $query->fetch_object()){
			$data[] = $r;
		}
	}
	return $data;
}

function get_niveles(){
	$con = connect();
	$sql = "select * from nivel_receta";
	$query  =$con->query($sql);
	$data =  array();
	if($query){
		while($r = $query->fetch_object()){
			$data[] = $r;
		}
	}
	return $data;
}

function get_nivel($id){
	$con = connect();
	$sql = "select * from nivel_receta where id_nivel=".$id;
	$query  =$con->query($sql);
	$data =  null;
	if($query){
		while($r = $query->fetch_object()){
			$data = $r;
			break;
		}
	}
	return $data;
}
