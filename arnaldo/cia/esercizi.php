<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel = "stylesheet" href = "../styles.css" type = "text/css" />
<script language="JavaScript">
function apri(url) {
var windowprops = "width= 600 ,height= 400";
popup = window.open(url,'remote',windowprops);
}

function elimina(matricola){
var r=confirm("Sicuro di eliminare "+matricola+" ?");
if (r==true)
  {
  window.location.assign("esercizi.php?del="+matricola);
  }
} 
</script>

</head>

<?php 
session_start();

include('../config.php');
include_once '../function.php';



$conn = mysql_connect('localhost','root','');
$db = mysql_select_db('arnaldo', $conn);

if(IsSet($_GET['del'])){
	$querydel=mysql_query("DELETE from esercizi WHERE  `id` =".$_GET['del']);
	}

?>

<body>
<h2> Elenco Esercizi </h2>

<div>
	<table border="2" >
		<tr> 
			<th>Marchio</th>
			<th>Cliente</th>
                        <th>Città</th>
			<th>Indirizzo</th>
			<th>Telefono</th>
		</tr>
		<?php 
		$query = mysql_query("SELECT * from esercizi");
		
		while($q = mysql_fetch_array($query)){
		$matricola=$q["id"];
		echo"<tr>
			<td> <a href='JavaScript:apri(\"scheda_esercizio.php?id=$matricola\");'>".$q["nome"]." </a></td>
			<td>".trovacliente($q["cliente"])."</td>
                        <td>".$q["citta"]."</td>    
			<td>".$q["indirizzo"]."</td>
			<td>".$q["telefono"]."</td>
			<td> <a href='modifica_esercizio.php?id=$matricola'> Modifica </a> </td>
			<td> <a href='JavaScript:elimina(\"".$matricola."\");'> Elimina </a> </td>
		</tr>";
		} ?>
	</table>
	<p>
	<a href="add_esercizio.php"> <button>Aggiungi un esercizio </button>  </a>
	</p>
</div>
<script>

</script>

</body>
</html>