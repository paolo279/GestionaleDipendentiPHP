<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel = "stylesheet" href = "../styles.css" type = "text/css" />
        <title></title>
    </head>
    <?php 
session_start();

include('../config.php');
include_once '../function.php';

$id=$_GET["id"];

if(IsSet($_GET['del'])){
	$query=mysql_query("DELETE from clienti WHERE  `partitaIva` =".$_GET['del']);
	}
if(IsSet($_GET['add'])){

	$query=mysql_query("INSERT INTO articoli_taglie (articolo_id,taglia) values ($id,'".$_POST["taglia"]."')");
	}    
        
if(IsSet($_GET['upd'])){

	$query=mysql_query("UPDATE articoli_taglie SET qnt_disponibile = qnt_disponibile + ".$_POST["qnt"]." WHERE id ='".$_GET['id_taglia']."'");
	}         
    
        $sql = mysql_query("SELECT * from articoli WHERE id=$id");
		while($q = mysql_fetch_array($sql)){
                $nome = $q["descrizione"];} 
                
                
?>

<body>
    
    
<h2> Dettaglio Articolo:  <?php echo $nome; ?> </h2>

<div>
	<table border="2" >
		<tr> 
			<th>Taglia</th>
			<th>Quantità Disponibile</th>
                        <th>Quantità Fuori</th>
		</tr>
                
		<?php 
		$q1= mysql_query("SELECT * FROM articoli_taglie WHERE articolo_id=$id");
		while($q = mysql_fetch_array($q1)){
                
                    echo"<tr>
                            <td> ".$q["taglia"]." </td>
                            <td> ".$q["qnt_disponibile"]." </td>
                            <td> ".$q["qnt_fuori"]." </td>
                                
                            <form action='scheda_articolo.php?upd&id=$id&id_taglia=".$q["id"]."' method='post'>
                                <td> <input type='number' name='qnt' size='3'> </td>
                                <td> <input type='submit' value='Aggiungi Quantità'> </td>
                                </form>
                        </tr>";}
		 ?>
                
	</table>
    
	<div>
            <h4>Aggiungi una taglia</h4>
            <form action="scheda_articolo.php?add&id=<?php echo $id; ?>" method="post">
                 <p> Nome Taglia: <input type="text" name="taglia" size="5">
                 <input type="submit" value="Aggiungi Taglia"> </p>
            </form>  
	
	</div>
</div>
<script>

</script>

</body>
</html>