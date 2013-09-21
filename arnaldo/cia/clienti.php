<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel = "stylesheet" href = "../styles.css" type = "text/css" />
<script language="JavaScript">
function apri(url) {
var windowprops = "width= 800 ,height= 600";
popup = window.open(url,'remote',windowprops);
}

function elimina(matricola){
var r=confirm("Sicuro di eliminare "+matricola+" ?");
if (r==true)
  {
  window.location.assign("clienti.php?del="+matricola);
  }
} 
</script>

</head>

<?php 
session_start();

include('../config.php');

if(IsSet($_GET['del'])){
	$query=mysql_query("DELETE from clienti WHERE  `partitaIva` =".$_GET['del']);
	}

?>

<body>
<h2> Elenco Clienti </h2>

<div>
	<table border="2" >
		<tr> 
			<th>Nome</th>
			<th>Amministratore</th>
			<th>Partita Iva</th>
			<th>Telefono</th>
		</tr>
		<?php 
		$query = mysql_query("SELECT * from clienti");
		while($q = mysql_fetch_array($query)){
		$matricola=$q["id"];
		echo"<tr>
			<td><a href='JavaScript:apri(\"scheda_cliente.php?id=$matricola\");'>".$q["nome"]." </a></td>
			<td>".$q["am_nome"]." ". $q["am_cognome"] ."</td>
			<td>".$q["partitaIva"]."</td>
			<td>".$q["telefono"]."</td>
			<td> <a href='JavaScript:apri(\"modifica_cliente.php?id=$matricola\");'> Modifica </a> </td>
			<td> <a href='JavaScript:elimina(\"$matricola\");'> Elimina </a> </td>
		</tr>";
		} ?>
	</table>
	<p>
	<a href="add_cliente.php"> <button>Aggiungi un cliente </button>  </a>
	</p>
</div>
<script>

</script>

</body>
</html>