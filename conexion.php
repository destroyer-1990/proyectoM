<html>
<body>

<?php



$db = new SQLite3('bdfrontend.db');
  if(!$db){
        echo $db->lastErrorMsg();
		} else {
	   echo "Opened database successfully\n";
	 }

$sql =<<<EOF

INSERT INTO usuarios(idusuario,login,password,orden) 
VALUES(6,'prueba','c893bad68927b457dbed39460e6afd62','ABCDEFGH');

EOF;

$ret = $db->exec($sql);

if(!$ret){
      echo $db->lastErrorMsg();
	     } else {
		       echo "Records created successfully\n";
			      }

$results = $db->query('SELECT * FROM usuarios');
while ($row = $results->fetchArray()) {
    var_dump($row);
	}
//$insert = $db->query('INSERT INTO usuarios values(6,\'prueba\',\'c893bad68927b457dbed39460e6afd62\',\'ABCDEFGHI\')');
	


$db ->close();

?>

</body>
</html>
