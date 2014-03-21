<?php
	$aux = require_once("cNodo.php");

	//No se pudo importar el archivo cNodo.php
	if (!$aux){
		header('Location: http://debian7proj.cloudapp.net/');
	}

	//variables post vacias y un poco de validación de datos en cuanto a idNode
	if ( $_POST["idNode"] < 10 ||$_POST["idNode"] > 0 || !is_int($_POST["idNode"]) || empty($_POST["idNode"]) || empty($_POST["comentario"]))
	header('Location: http://debian7proj.cloudapp.net/');
	
	$obj = new nodo();
	$obj->comentar($_POST["idNode"],$_POST["comentario"]);

	//Regresar usuario a la página de donde teóricamente llegó
	header('Location: http://debian7proj.cloudapp.net/articulo.php?idNode='.$_POST['idNode']);

?>
