<?php require_once('conDrupal/cListado.php');
/*
**Authors Marcelo Barrera (PHP) Octavio Dominguez (CSS, javascript)
*/
?>
<html>
	<head>
		<link rel="stylesheet" href="css/cstyle.css" type="text/css">
		<script src="//code.jquery.com/jquery-1.9.1.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	</head>
	<body>
		<div class="proy" >
		<a href="index.php">Inicio</a>
		<br>

<?php
echo $obj['sesion'];
echo "<br>\n<br>";
foreach($obj['articulos'] as $articulo){
	echo '<p><a href="articulo.php?idNode='.$articulo['idNode'].'">'.$articulo['fecha'].' - '.$articulo['titulo'].'</a></p>';
	
}

?>
			</div>
		</body> 
</html>

