
<?php
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
  
  #echo  str_replace($some2,$some,$contenido);
  #$contenido = str_replace('á','&aacute;',$contenido);
  #$contenido = str_replace('í','&iacute;',$contenido);
  #$contenido = str_replace('ó','&oacute;',$contenido);
  #$contenido = str_replace('ú','&uacute;',$contenido);
  #$contenido = str_replace('ñ','&ntilde;',$contenido);
  
  
  #echo '<br>';
  //Nombre de la imagen
  #$body = field_get_items('node',$node, 'field_image');
  #print ($body[0]['filename']);
  #echo '<br>';
  //Ruta de la imagen
  $body = field_get_items('node',$node, 'field_image');
  #print $body[0]['uri'];
  $imagen = $body[0]['uri'];
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