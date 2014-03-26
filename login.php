<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<!--Octavio Dominguez Salgado-->
<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="css/stylelogin.css" type="text/css">
		<script type="text/javascript" src="scripts/scriptlogin.js"></script>
</head>
<body>
<div class="container">
	<section id="content">
		<!--<form action="registro_correcto.php" method='POST'>  "http://debian7proj.cloudapp.net/cgi-bin/authMod.cgi"-->
<!--		<form action="http://debian7proj.cloudapp.net/cgi-bin/authMod.cgi"  method='POST'>	-->
		<form action="http://debian7proj.cloudapp.net/cgi/authMod.cgi"  method='POST'>
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
