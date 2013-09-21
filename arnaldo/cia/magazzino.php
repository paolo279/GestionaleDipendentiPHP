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
  window.location.assign("magazzino.php?del="+matricola);
  }
} 
</script>

</head>

<?php 
session_start();

include('../config.php');
include_once '../function.php';

if(IsSet($_GET['del'])){
        
        $sql = mysql_query("DELETE from articoli_taglie WHERE articolo_id =".$_GET["del"]);
	$query=mysql_query("DELETE from articoli WHERE  `id` =".$_GET['del']);
        
	}

?>

<body>
<h2> Gestione Casermaggio </h2>

<div>
	<table border="2" >
		<tr> 
			<th>Articolo</th>
			
		</tr>
		<?php 
		$query = mysql_query("SELECT * from articoli");
		while($q = mysql_fetch_array($query)){
		$id=$q["id"];
               // $taglie= cercaTaglie($id);
		echo"<tr>
			<td><a href='JavaScript:apri(\"scheda_articolo.php?id=$id\");'>".$q["descrizione"]." </a></td>
			<td> <a href='JavaScript:elimina(\"$id\");'> Elimina </a> </td>
		</tr>";
		} ?>
	</table>
	<p>
	<a href="add_articolo.php"> <button>Aggiungi un articolo </button>  </a>
	</p>
</div>
<script>

</script>

</body>
</html>