<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/start/jquery-ui.css" />
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
        <script src="../js/bootstrap.js"></script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
      
        
        $id = $_GET["id"];
        include('../config.php');
        
        
          if(IsSet($_GET["add"])){
                $q1=mysql_query("SELECT * FROM  `esercizi` WHERE  `id` =".$id);
                while($r=mysql_fetch_array($q1)){
		 $sql1=mysql_query("INSERT INTO servizio_esercizio (`id_esercizio`, `nome_esercizio`, `tipo_servizio`, `ora_inizio`, `ora_fine`) VALUES
		 ('".$id."','".$r["nome"]."','".$_POST["tipo_servizio"]."','".$_POST["ora_inizio"]."','".$_POST["ora_fine"]."')")or die(mysql_error());
		 }
	}
        
        
        if(IsSet($_GET["del"])){
                $servizio=$_GET["servizio"];
		 $sql=mysql_query("DELETE FROM servizio_esercizio WHERE (id,id_esercizio) = 
		 ('".$servizio."','".$id."')")or die(mysql_error());
	}
        
        $query=mysql_query("SELECT * FROM  `esercizi` WHERE  `id` =".$id)or die(mysql_error());

        while($q=mysql_fetch_array($query)){

        echo "<div class='modal-header'>
            <a class='close' data-dismiss='modal'>x</a>
            <h3 id='myModalLabel'> Dettaglio Esercizio: ".$q["nome"]." </h3>
            </div>
            <div class='modal-body'>";

        
            echo    "<p> Nome:  ".$q["nome"]."</p>
                    <p> Marchio:  ".$q["cliente"]."</p>
                    <p> Città: ".$q["citta"]." 
                        Indirizzo: ".$q["indirizzo"]."
                        CAP: ".$q["cap"]." </p>
                            
                    <p> Telefono: ".$q["telefono"]."
                        Email: ".$q["email"]."
                        Fax: ".$q["fax"]." </p>

                    <p> Responsabile: ".$q["responsabile"]."
                        </p>
                        
                    <p> Giorni Lavorativi: ".$q["giorni_lavorativi"]."
                        </p>";
            }?>
            
        <table>
            <table class="table table-striped table-condensed">
                    <tr>
                        <th> Tipologia Servizio</th>
                        <th> Ora inizio</th>
                        <th> Ora fine</th>
                    </tr>
        
        
        <?php
            $sql=mysql_query("SELECT * FROM  `servizio_esercizio` WHERE  `id_esercizio` =".$id);
                while($row=mysql_fetch_array($sql)){
                    echo"<tr>
                        <td> ".$row["tipo_servizio"]."</td>
                        <td> ".$row["ora_inizio"]."</td>
                        <td> ".$row["ora_fine"]."</td>
                        <td><a href='scheda_esercizio.php?del&id=".$id."&servizio=".$row["id"]."'> <button class='btn'> Cancella </button> </a></td>
                         </tr>";
      
                }
        
        ?>
                    
                    </table>
            
            
            <p>Aggiungi un servizio:</p>
            <p>
            <form action="scheda_esercizio.php?add&id=<?php echo $id; ?>" method="post">
                Tipologia Servizio: <input type="text" name="tipo_servizio" size="40">
                </br>
                Ora inizio: <input type="time" step="300" name="ora_inizio">
                Ora fine: <input type="time" step="300" name="ora_fine">
                </br>
                <input type="submit" value="Aggiungi Servizio">
            </form>
            </p>
        </div>
    </body>
</html>
