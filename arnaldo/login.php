<html>
<head>
<link rel = "stylesheet" href = "styles.css" type = "text/css" />
</head>


<body>
<h1> Benvenuto nel gestionale di Arnaldo </h1>

<div id="pippo">
	<form action="index.php" method="post">
		Username: <input type="text" name="username" size="15" > </br>
		Password: <input type="password" name="password" size="15"> </br>
		<input type="submit" value="Entra">
	</form>
	
	<?php 

		if(IsSet($_GET["errore"])) echo"<p> Hai sbagliato password!!</p>";
	?>
	
</div>

<body>
</html>