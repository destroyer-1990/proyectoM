
<?php

function getAll(){

  $articulos=array();
  for($i=1; $i<10;$i++){

    $node = node_load($i);                                 
    #echo '<br>';
    //fecha
    $fecha = getdate( $node->created );
    $fecha = $fecha["mday"]."-".$fecha["mon"]."-".$fecha["year"];
    #echo '<br>';
    //titulo de la nota, articulo, lo que sea
    #print($node->title);
    $titulo = $node->title;
    #print $comment->comment_body ["und"][0] ["value"];
    $arr = array('fecha' => $fecha,'titulo'=>$titulo );
    $articulos[''.$i]=$arr; 
    
  }

  $arr = 
    array(
        "articulos" => $articulos    
  );

  echo json_encode($arr);  

}

function getNode($nid){
  #Cargar, obtener el nodo,
  $node = node_load($nid);                                 
  #echo '<br>';
  //fecha
  $fecha = getdate( $node->created );
  $fecha = $fecha["mday"]."-".$fecha["mon"]."-".$fecha["year"];
  #echo '<br>';
  //titulo de la nota, articulo, lo que sea
  #print($node->title);
  $titulo = $node->title;
  #echo '<br>';
  //lenguaje
  #print($node->language);
  $lenguaje=$node->language;
  #echo '<br>';
  //Contenido del articulo
  $body = field_get_items('node',$node, 'body');
        #print (utf8_decode ($body[0]['value']));
  $contenido = $body[0]['value'];
  
  
  
  #echo '<br>';
  //Nombre de la imagen
  $body = field_get_items('node',$node, 'field_image');
  $imagen = ($body[0]['filename']);
  $rimagen = "/var/www/drupalsite/sites/default/files/styles/large/public/field/image/".$imagen;
  $imagen = base64_encode(file_get_contents($rimagen));
  $imagen = 'data: '.mime_content_type($rimagen).';base64,'.$imagen;
  $imagen = '<img src="',$imagen,'">';
  #echo '<br>';
  
  //Ruta de la imagen
  #$body = field_get_items('node',$node, 'field_image');
  #print $body[0]['uri'];
  #$imagen = $body[0]['uri'];
  #echo '<br>';
  //comentarios
  $result = db_select('comment') ->fields('comment', array('cid')) ->condition('nid', $node->nid, '=') ->execute();
  $cids = $result->fetchCol();
  $comments=comment_load_multiple($cids);
  $i=1;
  $comentarios=array();
  foreach($comments as $comment){
    #print $comment->comment_body ["und"][0] ["value"];
    $comentarios[''.$i] =utf8_encode ($comment->comment_body ["und"][0] ["value"]);
    $i++;
  }
  //Información completa del nodo, de manera algo complicada de accesar :S
  #print_r($node);

  $arr = 
    array(
        "fecha" => $fecha,
        "titulo" => $titulo,
        "lenguaje" => $lenguaje,
        "contenido" => $contenido,
        "imagen" => $imagen,
        "comentarios" => $comentarios    
  );

  echo json_encode($arr);
}
?>
