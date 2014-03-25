/*Octavio Domínguez Salgado*/
                <?php
                session_start();
                $_SESSION['usuario'] = "admin";
                $usuario = $_SESSION['usuario'];
                ?>
                var usuario  = '<?php echo $usuario; ?>';
	        function getUsuario(){
                        /*alert(usuario);*/
                        /*alert(variablejs);*/
			/*var usuario="admin";*/
                        if(usuario == 'admin' || usuario=='mortal'){
                                login.style.display = 'none';
                                if(usuario == 'admin')
                                        guardar.style.display = 'in-line';
                                $( "#sortable" ).sortable({
                                stop: function(event, ui)
                                {
                                debugger;
                                var posFin = ui.item.index();
                                var nombre = ui.item.prop('id');
                                var posIni = organization.filter(function(object){return (object.nombre == nombre)})[0].pos-1;
                                organization.sort(function(a,b){return (a.pos - b.pos)});//aqui tenia a.pos-b.pos
                                if(posFin >posIni)
                                        for(var i=posIni;i<=posFin;i++)//aqui tenia -1 +1
		                                organization[i].pos -= 1;
                                else
                                        for(var i=posFin;i<=posIni;i++)
                                                organization[i].pos += 1;
                                organization.filter(function(object){return (object.nombre == nombre)})[0].pos = posFin+1;//posFin+1
                                //}
                                var posicion = ""
                                for (var i=0; i<9; i++){
                                        posicion = posicion + organization.sort(function(a,b){return (a.pos - b.pos)})[i].id
                                }
                                alert(posicion);
                                }//fin de stop function
                                });
                                $( "#sortable" ).disableSelection();
                        }
                        else
                        {
                                login.style.display = 'in-line';
                                guardar.style.display = 'none';
                        }
                }//fin de get usuuario 
                var organization = new Object();
                organization = [{id:1, nombre:"draggable1", pos:1},{id:2, nombre:"draggable2", pos:2},{id:3, nombre:"draggable3", pos:3},{id:4, nombre:"draggable4", pos:4},{id:5, nombre:"draggable5", pos:5},{id:6, nombre:"draggable6", pos:6},{id:7, nombre:"draggable7", pos:7},{id:8, nombre:"draggable8", pos:8},{id:9, nombre:"draggable9", pos:9}]
                $(function() {
                        getUsuario();
                });
