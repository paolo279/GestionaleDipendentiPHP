<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
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
include_once '../function.php';
 $id=$_GET["id"];

if(IsSet($_GET["upd"])){
	
	if(IsSet($_POST["nome"])&&IsSet($_POST["partitaIva"])&&IsSet($_POST["telefono"])&&IsSet($_POST["email"])){
	
		 mysql_query("INSERT into clienti (nome,forma_giuridica,partitaIva,codice_fiscale,citta,indirizzo,cap,fax,telefono,
                 email,attivo,am_nome,am_cognome,am_telefono,costo_concordato,tipo_pagamento,tipo_contratto,data_inizio) values 
		 ('".$_POST["nome"]."','".$_POST["forma_giuridica"]."','".$_POST["partitaIva"]."','".$_POST["codice_fiscale"]."','".$_POST["citta"]."','".$_POST["indirizzo"]
                   ."','".$_POST["cap"]."','".$_POST["fax"]."','".$_POST["telefono"]."','".$_POST["email"]."','S','".$_POST["am_nome"]."','".$_POST["am_cognome"]."','"
                   .$_POST["am_telefono"]."','".$_POST["costo_concordato"]."','".$_POST["tipo_pagamento"]."','".$_POST["tipo_contratto"]."','".$_POST["data_inizio"]."')")or die(mysql_error());
                 
		header('Location: clienti.php');
		} else header('Location: add_cliente.php?errore');
	}
        
        $query = mysql_query("SELECT * from clienti WHERE id='$id'");
        while($res = mysql_fetch_array($query)){
            $q = $res;
        }
?>

<body>
<h2> Modifica Cliente </h2>

<div>
	<form action="modifica_cliente.php?upd&id=<?php echo $id; ?>" method="post">
		<p> Nome Cliente: <input type="text" name="nome" value="<?php echo $q["nome"]; ?>" size="30">
                    Forma Giuridica: <select name="forma_giuridica">
                        <option value="1" <?php if($q["forma_giuridica"]==="1") echo "selected"; ?> >Ditta Individuale</option>
                        <option value="2" <?php if($q["forma_giuridica"]==="2") echo "selected"; ?> >Cooperativa</option>
                        <option value="3" <?php if($q["forma_giuridica"]==="3") echo "selected"; ?> >Snc</option>
                        <option value="4" <?php if($q["forma_giuridica"]==="4") echo "selected"; ?> >Srl</option>
                        <option value="5" <?php if($q["forma_giuridica"]==="5") echo "selected"; ?> >Spa</option>
                    </select>
                </p>
    
                <p>
                    Partita Iva: <input type="text" value="<?php echo $q["partitaIva"]; ?>" name="partitaIva" size="20">
                    Codice Fiscale: <input type="text" value="<?php echo $q["codice_fiscale"]; ?>" name="codice_fiscale" size="20">
                </p>	
		<p> Città: <input type="text" value="<?php echo $q["citta"]; ?>" name="citta" size="20">
                    Indirizzo: <input type="text" name="indirizzo" value="<?php echo $q["indirizzo"]; ?>" size="25">
                    Cap: <input type="text" name="cap" value="<?php echo $q["cap"]; ?>" size="6">
                    Telefono: <input type="text" name="telefono" value="<?php echo $q["telefono"]; ?>" size="10">
                    Fax: <input type="text" name="fax" value="<?php echo $q["fax"]; ?>" size="10">
                    Email: <input type="text" name="email" value="<?php echo $q["email"]; ?>" size="20"> 
		</p>
                
                <p>
                    Dati Amministratore <br>
                    Nome: <input type="text" name="am_nome" value="<?php echo $q["am_nome"]; ?>" size="20">
                    Cognome: <input type="text" name="am_cognome" value="<?php echo $q["am_cognome"]; ?>" size="20">
                    Telefono: <input type="text" name="am_telefono" value="<?php echo $q["am_telefono"]; ?>" size="10">
                </p>
                
                <p>
                    Costo Concordato: <input type="text" name="costo_concordato" value="<?php echo $q["costo_concordato"]; ?>" size="6">
                </p>
                
                <p>
                    Tipologia Pagamento:  <select name="tipo_pagamento">
                        <option value="1" <?php if($q["tipo_pagamento"]==="1") echo "selected"; ?> >Rimessa Diretta</option>
                        <option value="2" <?php if($q["tipo_pagamento"]==="2") echo "selected"; ?> >10 GG</option>
                        <option value="3" <?php if($q["tipo_pagamento"]==="3") echo "selected"; ?> >15 GG</option>
                        <option value="4" <?php if($q["tipo_pagamento"]==="4") echo "selected"; ?> >30 GG</option>
                        <option value="5" <?php if($q["tipo_pagamento"]==="5") echo "selected"; ?> >60 GG</option>
                        <option value="6" <?php if($q["tipo_pagamento"]==="6") echo "selected"; ?> >90 GG</option>
                    </select>
                    
                    Tipologia Contrattuale:  <select name="tipo_contratto">
                        <option value="1" <?php if($q["tipo_contratto"]==="1") echo "selected"; ?> >Standard</option>
                        <option value="2" <?php if($q["tipo_contratto"]==="2") echo "selected"; ?> >Ordine di servizio</option>

                    </select>
                    
                    Data Inizio Rapporto: <input type="date" nome="data_inizio" value="<?php echo $q["data_inizio"]; ?>">
                </p>
                
               
                
		
		<p>	<input type="submit" value="Salve Modifiche" > </p>
	</form> 
</div>

</body>
</html>