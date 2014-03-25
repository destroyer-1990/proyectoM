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


$user=$_POST["usuario"];
$pass=$_POST["password"];
$conpass=$_POST["confirmar_password"];
echo "$user.$pass";
if($pass == $conpass){
if(preg_match("/^[a-z0-9]+$/",$user)){
        echo "<html><body><h1>paso el user</h1></body></html>";
        if(preg_match("/^[a-z0-9]+$/",$pass)){
                echo "<html><body><h1>paso el password</h1></body></html>";
        }
        else {
                echo "<html><body><h1>fallo el password</h1></body></html>";}
}else{
echo "<html><body><h1>fallo el uuario</h1></body></html>";}
}
else{
	header("Location: registro.php");
}
//$anterior = $nuevo + 1;
//$nuevo=$anterior+1;
$results = $db->query('select max(idusuario) from usuarios');
//print $results;
while($row = $results->fetchArray()){
var_dump($row);
//$rows = $consulta->numRows();

//echo "Number of rows:echo Number of rows: $rows";
}

//$lastid = $db->lastInsertRowid();
//echo "valor $lastid";
/*$consulta = sqlite_query($db, "SELECT * FROM usuarios");
$rows = sqlite_num_rows($consulta);
print "Numero de registros: $rows";
*/

//$consulta = $db->query("SELECT * FROM usuarios");
//$rows = $consulta->numRows();

//echo "Number of rows:echo Number of rows: $rows";


//$indice = 1;


$hashpass = md5($pass);

 $lastid = $db->lastInsertRowid();
    echo "valor antes $lastid";



$sql =<<<EOF
      INSERT INTO usuarios (idusuario,login,password,orden)
	  VALUES(13,'$user','$hashpass','ABCDEFGH');
EOF;

			 $ret = $db->exec($sql);
			     if(!$ret){
				           echo $db->lastErrorMsg();
						                } else {
										                   echo "Records created successfully\n";
														                         }   
$lastid = $db->sqlite_num_rows();
 echo "valor despues $lastid";

		$db->close();


?>

