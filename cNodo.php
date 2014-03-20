<?php

class nodo {
	public $fecha;
	public $contenido;
	public $imagen;
	public $lenguaje;
	public $comentarios;
	public $titulo;

	public function __construct($idNode){
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
		$this->comentarios=$obj['comentarios'];
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
}
?>
