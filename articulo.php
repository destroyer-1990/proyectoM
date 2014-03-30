<?php	require_once('conDrupal/cNodo.php');
/*
**Authors Marcelo Barrera (PHP) Octavio Dominguez (CSS - javascript)
*/
?>
<html>
        <head>
                <link rel="stylesheet" href="css/cstyle.css" type="text/css">
                <script src="//code.jquery.com/jquery-1.9.1.js"></script>
                <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
				<meta charset="utf-8">
        </head>
        <body>
                <div class="proy" >
				<a href="index.php">Inicio</a>
				<br>
				<a href="listado.php">Listado de articulos</a>
				<br>

<?php
    echo $obj->getSession();
	echo '<br>';

	echo '<p><span>Fecha de publicación: </span>';
	echo $obj->getFecha();
	echo '</p>';

	echo '<br>';

	echo '<p><span>Lenguaje de la publicación: </span> ';
	echo $obj->getLenguaje();
	echo '</p>';

	echo '<br>';

	echo '<p><span>Titulo: </span>';
	echo $obj->getTitulo();
	echo '</p>';

	echo '<br>';

	echo '<span>';
	echo $obj->getImagen();
	echo '</span></p>';
	
	echo '<br>';

	echo '<p><code><span>Contenido:</span><br>';
	echo $obj->getContenido();
	echo '</code></p>';
	
	echo '<br><br>';
	
	echo '<p><span>Comentarios: <br></span></p>';
	echo '<br>';
	$some = $obj->getComentarios();
	$i=1;
	foreach ($some as &$comentario) {
	
		echo '<p>Comentario '.$i.'<br><code>'.$comentario.'</code></p><br>';
		$i++;
	}
?>
			<form action="conDrupal/comentar.php" method="post">
				<p>
					<br>
						Comentario:<br><textarea id="field" cols="35" name="comentario" rows="4" ></textarea>
				</p>
				<p>
					<input id="boton" type="submit" value="Comentar"/></p>
					<input type="hidden" name="idNode" value="<?php echo $_GET['idNode'];?>">
					<br>
			</form>
		</div>
	</body>
</html>
