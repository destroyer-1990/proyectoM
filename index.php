<html>
             
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<link rel="stylesheet" href="mystyle.css" type="text/css"/>	
	        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
	        <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

	   	<?php
                session_start();
                $_SESSION['usuario'] = "admin";
                $usuario = $_SESSION['usuario'];
                ?> 
		<script src="//code.jquery.com/jquery-1.9.1.js"></script>
        	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

		<script type="text/javascript">
		var usuario  = '<?php echo $usuario; ?>';
		function getUsuario(){
			/*alert(usuario);*/
			/*alert(variablejs);*/
			if(usuario == 'admin' || usuario=='mortal'){
				login.style.display = 'none';
				if(usuario == 'admin')
					guardar.style.display = 'in-line';
				$( "#sortable" ).sortable({
	                        stop: function(event, ui)
        	                {
                                var posFin = ui.item.index();
                                var nombre = ui.item.prop('id');
                                var posIni = organization.filter(function(object){return (object.nombre == nombre)})[0].pos;
                                organization.sort(function(a,b){return (a.pos - b.pos)});
                                if(posFin >posIni)
                                        for(var i=posIni-1;i<posFin+1;i++)
                                                organization[i].pos -= 1;
                                else
                                        for(var i=posFin;i<posIni;i++)
                                                organization[i].pos += 1;
                                organization.filter(function(object){return (object.nombre == nombre)})[0].pos = posFin+1;
                	        }
                		});
		                $( "#sortable" ).disableSelection();
			}
			else
			{
				login.style.display = 'in-line';
				guardar.style.display = 'none';
			}
		}
		var organization = new Object();
		organization = [{id:1, nombre:"draggable1", pos:1},{id:2, nombre:"draggable2", pos:2},{id:3, nombre:"draggable3", pos:3},{id:4, nombre:"draggable4", pos:4},{id:5, nombre:"draggable5", pos:5},{id:6, nombre:"draggable6", pos:6},{id:7, nombre:"draggable7", pos:7},{id:8, nombre:"draggable8", pos:8},{id:9, nombre:"draggable9", pos:9}]
		$(function() {
		getUsuario();
		});
	</script>
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
			/*$array = array(1,2,4,7,8,3,5,6,9);*/
			$array =  array(1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,7 => 7,8 => 8,9 => 9);
			foreach($array as $num=>$num_v):?>
			<li id="draggable<?=$num_v?>" ><a href="articulo.php?idNode=<?=$num_v?>"><img src="pokebola.png" alt="" width="250" height="200"><small>casilla numero <?=$num_v?></small></a></li>
			<?php endforeach; ?>
		</ul>
		</div>
	</body>
</html>
