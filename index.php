<html>
<!--Octavio Dominguez Salgado-->
<?php session_start(); $u;if (empty($_SESSION['user'])){$u=0;}else{$u=1;}?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" href="css/mystyle.css" type="text/css"/>	
	        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
	        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script type="text/javascript" src="scripts/posicion.php"></script>
     	</head>
	<body>        
	<?php if($u) echo '<h2>Bienvenido: '.$_SESSION['user'].'</h2>'."\n";?>
		<div id="cabecera" align= "right" >
		<form action="login.php" method='POST'>
		<input id="login" type="submit" value="login">
		</form>
	<?php if ($u){  ?>
		<form action="login.php" method='POST'>
                <input id="guardar" type="submit" value=posicion>
		</form><?php } ?>
	<?php if ($u){echo '<a href="cierre.php"><h2>Cierre de sesion</h2></a> '."\n";} ?>
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
