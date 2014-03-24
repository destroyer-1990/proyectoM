<?php
   class MyDB extends SQLite3
      {
	        function __construct()
			      {
				           $this->open('bdfrontend.db');
						         }
								    }

$db = new MyDB();
   if(!$db){
         echo $db->lastErrorMsg();
		    } else {
			      echo "Opened database successfully\n";
				  }

$sql =<<<EOF
      INSERT INTO usuarios (idusuario,login,password,orden)
	  VALUES(6,'prueba','c893bad68927b457dbed39460e6afd62','ABCDEFGH');
EOF;

 $ret = $db->exec($sql);
    if(!$ret){
	      echo $db->lastErrorMsg();
		     } else {
			       echo "Records created successfully\n";
				      }
					     $db->close();
						 ?>
