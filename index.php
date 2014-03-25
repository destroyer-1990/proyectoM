<html>
<!--Octavio Dominguez Salgado-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" href="css/mystyle.css" type="text/css"/>	
	        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
	        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script type="text/javascript" src="scripts/posicion.php"></script>
     	</head>
	<body>        
		<div id="cabecera" align= "right" >
		<form action="login.php" method='POST'>
		<input id="login" type="submit" value="login">
		</form>
		<form action="login.php" method='POST'>
                <input id="guardar" type="submit" value=posicion>
                </form>
		</div>
        <div class="proy">
		<ul id="sortable">
			<?php
			/*$array =  array(1 => 1,2 => 2,3 => 4,4 => 7,5 => 8,6 => 3,7 => 5,8 => 6,9 => 9);*/
			$array = array(1,2,3,4,5,6,7,8,9);
			foreach($array as $num):?>
			<li id="draggable<?=$num?>" ><a href="articulo.php?idNode=<?=$num?>"><img src="css/imagenes/pokebola.png" alt="" width="250" height="200"><small>casilla numero <?=$num?></small></a></li>
			<?php endforeach; ?>
		</ul>
		</div>
	</body>
</html>
