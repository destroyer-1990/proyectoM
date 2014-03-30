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
	<?php if($u) echo '<h2>Bienvenido: '.$_SESSION['user'].'</h2>'."\n";
	/*Aqui va la parte de la base*/

	class MyDB extends SQLite3
	            {
	                     function __construct(){
								   $this->open('scripts/base2.db');
			                                          }
			                                          }
				  
				                   $db = new MyDB();
				                         if(!$db){
				                                echo $db->lastErrorMsg();
					                           } else {
                                      //echo "Opened database successfully\n";
					                                         }

//$usuario=$_SESSION['user'];
echo $_SESSION['user'];
//$usuario = "duby";	
$usuario = $_SESSION['user'];

$sql =<<<EOF
SELECT orden from usuarios where login='$usuario';
EOF;


$ret = $db->query($sql);
              while($row = $ret->fetchArray(SQLITE3_ASSOC) ){                   //echo "orden = ". $row['orden'] . "\n";
   
$orden = $row['orden'];
//print "Variable extraida:$orden\n";
   
}



	/*****************/
	
	?>
		<div id="cabecera" align= "right" >
		<form action="login.php" method='POST'>
		<input id="login" type="submit" value="login">
		</form>
	<?php if ($u){
		echo '<a href=index.php><input id="guardar" type="submit" value="Guardar" style="cursor:pointer;width:55px;"></a>';
		} ?>
	<?php if ($u && $usuario == 'admin'){
		echo '<a href=registro.php><input id="RegistrarU" type="submit" value="RegistrarU" style="cursor:pointer;width:55px;"></a>';
		} ?>
	<?php if ($u){echo '<a href="cierre.php"><h2>Cierre de sesion</h2></a> '."\n";} ?>
		</div>
        <div class="proy">
		<ul id="sortable">
			<?php
			/*$array =  array(1 => 1,2 => 2,3 => 4,4 => 7,5 => 8,6 => 3,7 => 5,8 => 6,9 => 9);*/
			//$string = "213456789";
			$string = $orden;
			//print "Variable extraida:$orden\n";
	        //$array = array(2,1,3,4,5,6,7,8,9);
			$array = str_split($string);
			foreach($array as $num):?>
			<li id="draggable<?=$num?>" ><a href="articulo.php?idNode=<?=$num?>"><img src="css/imagenes/pokebola.png" alt="" width="250" height="200"><small>casilla numero <?=$num?></small></a></li>
			<?php endforeach;
			$db->close(); ?>
		</ul>
		</div>
	</body>
</html>
