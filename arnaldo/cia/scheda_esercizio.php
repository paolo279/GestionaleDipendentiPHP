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
                        Tipologia Servizio: ".$q["tipo_servizio"]."
                        </p>
                        
                    <p> Giorni Lavorativi: ".$q["giorni_lavorativi"]."
                        Ora inizio: ".$q["ora_inizio"]."
                        Ora fine: ".$q["ora_fine"]."    
                        </p>";
            }

        echo "</div>";
        ?>
    </body>
</html>
