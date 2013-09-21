<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel = "stylesheet" href = "../styles.css" type = "text/css" />
<script language="JavaScript">
function apri(url) {
var windowprops = "width= 600 ,height= 400";
popup = window.open(url,'remote',windowprops);
}
</script>
</head>

<?php 
session_start();

include('../config.php');

if(IsSet($_GET["add"])){
	
	if(IsSet($_POST["nome"])&&IsSet($_POST["partitaIva"])&&IsSet($_POST["telefono"])&&IsSet($_POST["email"])){
	
		 mysql_query("INSERT into clienti (nome,forma_giuridica,partitaIva,codice_fiscale,citta,indirizzo,cap,fax,telefono,
                 email,attivo,am_nome,am_cognome,am_telefono,costo_concordato,tipo_pagamento,tipo_contratto,data_inizio) values 
		 ('".$_POST["nome"]."','".$_POST["forma_giuridica"]."','".$_POST["partitaIva"]."','".$_POST["codice_fiscale"]."','".$_POST["citta"]."','".$_POST["indirizzo"]
                   ."','".$_POST["cap"]."','".$_POST["fax"]."','".$_POST["telefono"]."','".$_POST["email"]."','S','".$_POST["am_nome"]."','".$_POST["am_cognome"]."','"
                   .$_POST["am_telefono"]."','".$_POST["costo_concordato"]."','".$_POST["tipo_pagamento"]."','".$_POST["tipo_contratto"]."','".$_POST["data_inizio"]."')")or die(mysql_error());
                 
		header('Location: clienti.php');
		} else header('Location: add_cliente.php?errore');
	}
?>

<body>
<h2> Aggiungi un cliente </h2>

<div>
	<form action="add_cliente.php?add" method="post">
		<p> Nome Cliente: <input type="text" name="nome" size="30">
                    Forma Giuridica: <select name="forma_giuridica">
                        <option value="1">Ditta Individuale</option>
                        <option value="2">Cooperativa</option>
                        <option value="3">Snc</option>
                        <option value="4">Srl</option>
                        <option value="5">Spa</option>
                    </select>
                </p>
    
                <p>
                    Partita Iva: <input type="text" name="partitaIva" size="20">
                    Codice Fiscale: <input type="text" name="codice_fiscale" size="20">
                </p>	
		<p> Città: <input type="text" name="citta" size="20">
                    Indirizzo: <input type="text" name="indirizzo" size="25">
                    Cap: <input type="text" name="cap" size="6">
                    Telefono: <input type="text" name="telefono" size="10">
                    Fax: <input type="text" name="telefono" size="10">
                    Email: <input type="text" name="email" size="20"> 
		</p>
                
                <p>
                    Dati Amministratore <br>
                    Nome: <input type="text" name="am_nome" size="20">
                    Cognome: <input type="text" name="am_cognome" size="20">
                    Telefono: <input type="text" name="am_telefono" size="10">
                </p>
                
                <p>
                    Costo Concordato: <input type="text" name="costo_concordato" size="6">
                </p>
                
                <p>
                    Tipologia Pagamento:  <select name="tipo_pagamento">
                        <option value="1">Rimessa Diretta</option>
                        <option value="2">10 GG</option>
                        <option value="3">15 GG</option>
                        <option value="4">30 GG</option>
                        <option value="5">60 GG</option>
                        <option value="6">90 GG</option>
                    </select>
                    
                    Tipologia Contrattuale:  <select name="tipo_contratto">
                        <option value="1">Standard</option>
                        <option value="2">Ordine di servizio</option>

                    </select>
                    
                    Data Inizio Rapporto: <input type="date" nome="data_inizio">
                </p>
                
               
                
		
		<p>	<input type="submit" value="Aggiungi Cliente" > </p>
	</form> 
</div>

</body>
</html>