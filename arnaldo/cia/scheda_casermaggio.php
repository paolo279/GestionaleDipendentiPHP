<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>

    <?php 

    include('../config.php');
    $id = $_GET["id"];
    
    if(isset($_GET["add"])){
        $sql1= mysql_query("INSERT INTO `arnaldo`.`record_casermaggio` (`matricola_id`, `taglia_id`, `qnt`) VALUES ('".$id."', '".$_POST["taglia_id"]."', '".$_POST["qnt"]."')")or die(mysql_error());
        
    }


    $query=mysql_query("SELECT * FROM  `dipendenti` WHERE  `id` =".$id)or die(mysql_error());

    while($q=mysql_fetch_array($query)){
    echo "<h3> Scheda Casermaggio: ".$q["nome"]." ".$q["cognome"]." </h3>";
        }
    ?>
        <form action="scheda_casermaggio.php?add&id=<?php echo $id ?>" method="post">
        <p> 
            Aggiungi articolo: <select name="taglia_id">
            <?php
                $q1=mysql_query("SELECT * FROM  `articoli` ")or die(mysql_error());
                while ($row = mysql_fetch_array($q1)) {
                    $q2=mysql_query("SELECT * FROM  `articoli_taglie` WHERE articolo_id =".$row["id"])or die(mysql_error());
                    while ($row1 = mysql_fetch_array($q2)) {
                        echo "<option value='".$row1["id"]."'> ".$row["descrizione"]." - ".$row1["taglia"]." </option>";
                    }
                }
            ?>
                </select>
            quantità: <input type="number" min="0" max="10" name="qnt" > 
            <input type="submit" value="Aggiungi">
        </p>
        </form>
        <table border="2" >
		<tr> 
			<th>Articolo</th>
                        <th>Quantità</th>
                        <th>Data</th>
		</tr>
                <?php
                    $sql=mysql_query("SELECT * FROM  `record_casermaggio` WHERE matricola_id='".$id."' AND attivo='S'")or die(mysql_error());
                    while($row2 = mysql_fetch_array($sql)){
                        echo"<tr> 
                             <td> ".$row2["taglia_id"]." </td>
                             <td> ".$row2["qnt"]." </td>
                             <td> ".$row2["data_rilascio"]." </td>
                             </tr>";
                    }
                ?>
                
        </table>
</body>
</html>