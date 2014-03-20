<html>
        <head>
                <link rel="stylesheet" href="cstyle.css" type="text/css">
                <script src="//code.jquery.com/jquery-1.9.1.js"></script>
                <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
				<meta charset="utf-8">
        </head>
        <body>
                <div class="proy" >
<?php
if(empty($_GET['idNode']))
return;

require_once('cNodo.php');
$obj= new nodo($_GET['idNode']);
//print_r( $obj);
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

#echo '<br><br>Imagen<br><br>';
echo '<span>';
echo $obj->getImagen();
echo '</span></p>';

echo '<br>';

echo '<p><span>Contenido:</span><br>';
echo $obj->getContenido();
#echo '</p>';

echo '<br><br>';

echo '<p><span>Comentarios: <br></span></p>';
echo '<br>';
$some = $obj->getComentarios();
$i=1;
foreach ($some as &$comentario) {
	
	echo '<p>Comentario '.$i.'<br>'.$comentario.'</p><br>';
	$i++;
}

?>
		</div>
	</body>
</html>
