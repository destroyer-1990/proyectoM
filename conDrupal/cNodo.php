<?php
#
# Author Marcelo Barrera
#


class nodo {
	public $fecha;
	public $contenido;
	public $imagen;
	public $lenguaje;
	public $comentarios;
	public $titulo;

	public function getSession(){
		 session_start(); 
		 if(!empty($_SESSION['user'])) 
		 	return "\n".'<a href="cierre.php"><h4>Cierre de sesion</h4></a>'."\n";
		
	}
	public function getNodo($idNode){
		$url = 'http://chelo.cloudapp.net/?q=sw/rest';

		//PAra obtener datos de un nodo (articulo)
		$data = array('idNode' => $idNode);

		// use key 'http' even if you send the request to https://...
		$options = array(
    		'http' => array(
	    	    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				    'method' => 'POST',
			    	    'content' => http_build_query($data),
			  ),
		);

		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		#echo $result;
	
		$obj = json_decode($result,true);
		
		$this->fecha=$obj['fecha'];
		$this->lenguaje=$obj['lenguaje'];
		$this->titulo=$obj['titulo'];
		$this->imagen=$obj['imagen'];

		//intentando combatir XSS
	          $no =array ("<",">");
	          $si =array ("&lt;","&gt; ");
	          $ncom=str_replace($no,$si,$obj['comentarios']);

		$this->comentarios=$ncom;
		$this->contenido=$obj['contenido'];
		}
	public function getFecha(){
		return $this->fecha;
	}
	
	public function getTitulo (){
		return $this->titulo ;
	}

	public function getLenguaje (){
		return $this->lenguaje ;
	}

	public function getContenido (){
		return $this->contenido ;
	}

	public function getImagen (){
		return $this->imagen ;
	}

	public function getComentarios (){
		return $this->comentarios ;
	}


	public function comentar($idNode,$comentario){
		$url = 'http://chelo.cloudapp.net/?q=sw/rest';

		//PAra obtener datos de un nodo (articulo)
		$data = array('idNode' => $idNode,'comentario'=> $comentario);

		// use key 'http' even if you send the request to https://...
		$options = array(
    		'http' => array(
	    	    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				    'method' => 'POST',
			    	    'content' => http_build_query($data),
			  ),
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url,false,$context);
		echo $result;
	}
}
        if(empty($_GET['idNode'])){
    	    $obj= new nodo();
        }else{
    	    $obj= new nodo();
	        $obj->getNodo($_GET['idNode']);
		}
?>
