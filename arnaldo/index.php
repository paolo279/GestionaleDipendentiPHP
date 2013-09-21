<!DOCTYPE html>
<html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php 
session_start();

include './config.php';

if(IsSet($_POST['username']) && IsSet($_POST['password'])) 
	{    
			$user =	mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password']);

			$query = mysql_query("SELECT * from `admin` WHERE (username , password) = ('$user','$password') ");
		
		If($q = mysql_fetch_array($query)){
			
			$_SESSION['user']=$q["username"];
		
		}else  header('Location: login.php?errore');
		
	}
  
  
	if($_SESSION['user'] == null) header('Location: login.php');
?>

<body>


<div class="container">

<h2> Benvenuto nel gestionale di Arnaldo </h2>
<a href="cia">
<img class="img-polaroid" src="img/cia.png"> </a>
<a href="cia">
<img src="img/fbi.png"> </a>
</div>
</body>
</html>