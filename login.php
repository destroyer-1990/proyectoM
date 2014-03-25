<!DOCTYPE html>
<!--Octavio Dominguez Salgado-->
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/stylelogin.css" type="text/css">
		<script>
		init:function clear()
		{
			user.value = "";
                        pass.value = "";
                        document.getElementById("message").innerHTML = "";
			user.className = "";
			pass.className = "";
		}
		function validateUser(user){
			var expr=/^([a-z0-9]{5,10})$/;
			var errorMessage = 'Usuario Incorrecto.';
    			if (expr.test(user.value)) {
        			user.className = "";
				document.getElementById("message").innerHTML = "";
   			} else {
        			user.className="invalido";
				user.value="";
				document.getElementById("message").innerHTML = errorMessage;
    			}
		}
              	function validatePass(pass){
                        var expr=/^([a-z0-9]{5,10})$/;
                        var errorMessage = 'Password Incorrecta.';
                        if ((expr.test(pass.value)) && (pass.value!='')) {
                                pass.className = "";
				document.getElementById("message").innerHTML = "";
                        } else {
                                pass.className="invalido";
				pass.value="";
				document.getElementById("message").innerHTML = errorMessage;
				/*message.value=errorMessage;
				var text = document.getElementById("message").InnerTect*/
                        }
                }
		</script>
</head>
<body>
<div class="container">
	<section id="content">
		<!--<form action="registro_correcto.php" method='POST'>  "http://debian7proj.cloudapp.net/cgi-bin/authMod.cgi"-->
		<form action="http://debian7proj.cloudapp.net/cgi-bin/authMod.cgi"  method='POST'>
			<h1>Login Form</h1>
			<div>
				<input type="text" placeholder="Username" required="true" name="user" onblur="validateUser(this);"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="true" name="pass" onblur="validatePass(this);"/>
			</div>
			
				<label id="message"></label>
						     
			<div>
				<input type="submit" value="Login"/>
		<!--		<a href="#">Lost your password?</a>-->
		<a href="registro.php">Registro</a>
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>
