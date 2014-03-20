<?php
	if (empty($_POST["idNode"])||empty($_POST["comentario"]))
	return;
	
	require_once("cNodo.php");
	echo 'hola';
	
	$obj = new nodo();

	$obj->comentar($_POST["idNode"],$_POST["comentario"]);

	header('Location: http://debian7proj.cloudapp.net/articulo.php?idNode='.$_POST['idNode']);
?>
