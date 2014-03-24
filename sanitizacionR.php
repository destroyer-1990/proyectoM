<?php
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
?>

