<!DOCTYPE html>
<html>
<head>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>

<?php 
session_start();
?>

<body>

<div class="navbar">
	 <div class="navbar-inner">
	 <a class="brand">Menu</a>
	 <ul class="nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="dipendenti.php">Dipendenti</a></li>
      <li><a href="clienti.php">Clienti</a></li>
	  <li><a href="esercizi.php">Esercizi</a></li>
	  <li><a href="turni.php">Turni</a></li>
	  <li><a href="magazzino.php">Magazzino</a></li>
    </ul>
	 
	 
		
	</div>
</div>

<div class="container">
	<h3> Gestione della CIA </h3>
	<table class="table" >
			<tr> 
			<td> <a href="dipendenti.php"> 
					Gestione Dipendenti </a> 
			</td>  
		</tr>
		<tr> 
			<td> <a href="clienti.php"> 
					Gestione Clienti 
				</a> 
			</td>  
		</tr>
		<tr> 
			<td> <a href="esercizi.php"> 
					Gestione Esercizi 
				</a> 
			</td>  
		</tr>
		<tr> 
			<td> <a href="magazzino.php"> 
					Gestione Magazzino 
				</a> 
			</td>  
		</tr>
		<tr> 
			<td> <a href="turni.php"> 
					Gestione Turni 
				</a> 
			</td>  
		</tr>
	</table>

</div>

</body>
</html>