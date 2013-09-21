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

        $giorni= implode("|", $_POST["giorni"]);
  
	if(IsSet($_POST["nome"])&&IsSet($_POST["cliente"])&&IsSet($_POST["indirizzo"])&&IsSet($_POST["telefono"])){
	
		 mysql_query("INSERT into esercizi (nome,cliente,citta,indirizzo,cap,telefono,fax,email,responsabile,tipo_servizio,giorni_lavorativi,
                     ora_inizio,ora_fine) 
                     values 
		 ('".$_POST["nome"]."','".$_POST["cliente"]."','".$_POST["citta"]."','".$_POST["indirizzo"]."','".$_POST["cap"]."','".$_POST["telefono"]."','".$_POST["fax"]."','".$_POST["email"]."','".$_POST["responsabile"]
                  ."','".$_POST["tipo_servizio"]."','".$giorni."','".$_POST["ora_inizio"]."','".$_POST["ora_fine"]."')")or die(mysql_error());
		header('Location: esercizi.php');
		} else header('Location: add_esercizi.php?errore');
	}
?>

<body>
<h2> Aggiungi un esercizio </h2>

<div>
	<form action="add_esercizio.php?add" method="post">
		<p> Marchio: <input type="text" name="nome" size="30">
                    Cliente: <select name="cliente">
			
				<?php 
					$query = mysql_query("SELECT * from clienti");
					while($q = mysql_fetch_array($query)){

					echo"<option value='".$q["id"]."'>".$q["nome"]."</option>";}
				?>
				
				</select>
                </p>
			
		<p> 
                    Città: <input type="text" name="citta" size="20">
                    Indirizzo: <input type="text" name="indirizzo" size="30">
                    Cap: <input type="text" name="cap" size="6">
		</p>
                
                <p> 
                    Telefono: <input type="text" name="telefono" size="10">
                    Fax: <input type="text" name="email" size="10">
                    Email: <input type="text" name="email" size="20">
		</p>
                
		<p> 
                    Responsabile: <input type="text" name="responsabile" size="20">
                    Tipologia Servizio: <input type="text" name="tipo_servizio" size="40">
		</p>
                
                <p>
                    Giorni Lavorativi:
                    <select multiple name='giorni[]' >
                        <option value="1">Lunedì</option>
                        <option value="2">Martedi</option>
                        <option value="3">Mercoledì</option>
                        <option value="4">Giovedì</option>
                        <option value="5">Venerdì</option>
                        <option value="6">Sabato</option>
                        <option value="0">Domenica</option>
                    </select>
                    
                    Ora inizio: <input type="time" step="300" name="ora_inizio">
                    Ora fine: <input type="time" step="300" name="ora_fine">
                </p>
		
		<p>	<input type="submit" value="Aggiungi Esercizio" > </p>
	</form> 
	
</div>

</body>
</html>