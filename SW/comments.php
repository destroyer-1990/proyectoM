<?php
	function addComment($Comentario,$idNode){
	  $comment = (object) array(
	    'nid' => $idNode,
	    #'cid' => 0,
	    #'pid' => 0,
	    #'uid' => 1,
	    #'mail' => '',
	    'is_anonymous' => 1,
	    #'homepage' => '',
	    'status' => COMMENT_PUBLISHED,
	    #'subject' => 'dsk subject',
	    'language' => LANGUAGE_NONE,
	    'comment_body' => array(
	      LANGUAGE_NONE => array(
	        0 => array (
	          'value' => $Comentario,
	          'format' => 'filtered_html'
	        )
	      )
	    ),
	  );
	  comment_submit($comment);
	  comment_save($comment);


	  $arr = 
	    array(
	        "mensaje" => "Comentario agregado");

	  echo json_encode($arr);
	}

?>