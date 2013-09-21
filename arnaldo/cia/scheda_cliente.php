<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/start/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../js/bootstrap.js"></script>
</head>

<?php 
session_start();
?>

<body>

<?php 

$matricola = $_GET["id"];
include('../config.php');

$query=mysql_query("SELECT * FROM  `clienti` WHERE  `id` =".$matricola)or die(mysql_error());



echo "<div class='modal-header'>
        <a class='close' data-dismiss='modal'>x</a>
        <h3 id='myModalLabel'> Dettaglio Cliente: $matricola </h3>
      </div>
      <div class='modal-body'>";

while($q=mysql_fetch_array($query)){
	echo"<p> Nome:  ".$q["nome"]."</p>
		 <p> Amministratore: ".$q["am_nome"]." ".$q["am_cognome"]. "</p>
		 <p> Partita Iva:  ".$q["partitaIva"]."</p>
		 <p> Telefono: ".$q["telefono"]."</p>
		 <p> Forma Giuridica: ".$q["forma_giuridica"]."</p>
                 <p> Codice Fiscale: ".$q["codice_fiscale"]."</p>
                 <p> Città: ".$q["citta"]."</p>
                 <p> Indirizzo: ".$q["indirizzo"]."</p>
                 <p> Cap: ".$q["cap"]."</p>
                 <p> Fax: ".$q["fax"]."</p>
                 <p> Telefono: ".$q["telefono"]."</p>
                 <p> Email: ".$q["email"]."</p>
                 <p> Telefono Amministratore: ".$q["am_telefono"]."</p>
                 <p> Costo Concordato: ".$q["costo_concordato"]." €</p>
                 <p> Costo Straordinario: ".$q["costo_straordinario"]."</p>
                 <p> Costo Notturno: ".$q["costo_notturno"]."</p>
                 <p> Costo Festivo: ".$q["costo_festivo"]."</p>
                 <p> Tipologia Pagamento: ".$q["tipo_pagamento"]."</p>
                 <p> Tipologia Contrattuale: ".$q["tipo_contratto"]."</p>
                 <p> Data Inizio Rapporto: ".$q["data_inizio"]."</p>";
}   

   echo "</div>";
?>

    <div class="modal-footer">
            <a class="btn btn-primary" onclick="$('.modal-body > form').submit();">Save Changes</a>
            <a class="btn" data-dismiss="modal">Close</a>
        </div>
</body>
</html>