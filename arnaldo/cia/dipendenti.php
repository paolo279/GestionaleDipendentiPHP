<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/start/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../js/bootstrap.js"></script>

<script language="JavaScript">
function apri(url) {
var windowprops = "width= 600 ,height= 400";
popup = window.open(url,'remote',windowprops);
}


function apriModal(url) {

$.get(url, function(data) {
			$('<div class="modal hide fade">' + data + '</div>').modal();
		}).success(function() { $('input:text:visible:first').focus(); });
	}



function elimina(matricola){
   
    var r=confirm("Sicuro di eliminare "+matricola+" ?");
    if (r==true)
    {
        window.location.assign("dipendenti.php?del="+matricola);
    }
} 



function popup(url,matricola) {	
var tag = $("<div></div>");
  $.ajax({
    url: url,
    success: function(data) {
      tag.html(data).dialog({
		modal: true,
		title:"Dettaglio Matricola: "+matricola,
		position: { my: "center bottom", at: "center top"},
		buttons: {
			Elimina: function(){
				elimina(matricola);
				}
			
			},
		width: 500,
		height: 500,
		show: {
        effect: "clip",
        duration: 1000
			},
		hide: {
        effect: "shake",
        duration: 1000
			}
		}).dialog('open');
    }
  });
  }
</script>

</head>

<?php 
session_start();

include('../config.php');

if(IsSet($_GET['del'])){
	$query=mysql_query("DELETE from dipendenti WHERE  `matricola` =".$_GET['del']);
	}
?>

<body>

<div class="navbar navbar-inverse">
	 <div class="navbar-inner">
	 <a class="brand">Menu</a>
	 <ul class="nav">
      <li><a href="index.php">Home</a></li>
      <li class="active"><a href="dipendenti.php">Dipendenti</a></li>
      <li><a href="clienti.php">Clienti</a></li>
	  <li><a href="esercizi.php">Esercizi</a></li>
	  <li><a href="turni.php">Turni</a></li>
	  <li><a href="magazzino.php">Magazzino</a></li>
    </ul>
	 
	 
		
	</div>
</div>


<div class="container">

	<div class="page-header">
		<h2>Elenco Dipendenti operativi</h2>
	</div>

	<table  class="table table-striped table-hover table-condensed" >
		<tr> 
			<th>Nome Cognome</th>
			<th>Operatore</th>
			<th>Contratto</th>
                        <th>Telefono</th>
		</tr>
		<?php 
		$query = mysql_query("SELECT * from dipendenti");
		while($q = mysql_fetch_array($query)){
		$matricola=$q["matricola"];
                $id=$q['id'];
                //<td> <a  onclick='apriModal(\"scheda_dip.php?id=$id\")'>".$q["nome"]." ".$q["cognome"]."</a></td>
		echo"<tr>
			<td> <a  href='scheda_dip.php?id=$id'>".$q["nome"]." ".$q["cognome"]."</a></td>
             
			<td>".$matricola."</td>
			<td>".$q["tipo"]."</td>
                        <td>".$q["telefono_mobile"]."</td>    
			<td> 
				<a onclick='apriModal(\"modifica_dipendente.php?id=$id\")' role='button' data-toggle='modal' class='btn btn-warning btn-small'> Modifica </a>
				<a href='JavaScript:elimina(\"$matricola\");'> <button class='btn btn-danger btn-small'> Elimina </button></a> 
			</td>
	
		</tr>";
		} ?>
	</table>
	<p>
	<a href="#add_dip" role="button" class="btn btn-primary" data-toggle="modal"> Aggiungi un dipendente  </a>
        <a href="add_dipendente.php" class="btn" > Aggiungi un dipendente  </a>
	</p>
</div>


<div id="add_dip" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel"> Aggiungi un dipendente </h3>
	</div>
    
	<form action="add_dipendente.php?add" method="post">
	<div class="modal-body">
            <label>Nome</label>
                <input type="text" name="nome" size="20">
            <label>Cognome</label>
                <input type="text" name="cognome" size="20">
            <label>Matricola</label>
                <input type="text" name="matricola" size="20">
            <label>Tipo Dipendente:</label>
                <select name="tipo">
                    <option value="1">Dipendente</option>
                    <option value="2">Collaboratore</option>
                </select>
           
            
            <label>Nazionalità</label> 
                <input type="text" name="nazionalita" size="20">
            <label>Città di nascita</label>
                <input type="text" name="luogo_nascita" size="30">
            <label>Data di nascita</label>
                <input type="date" name="data_nascita" >
            <label>Stato civile</label>
                    <select name="stato_civile">
                        <option value="1">Celibe</option>
                        <option value="2">Coniugato</option>
                        <option value="3">Divorziato</option>
                    </select>
                                    
                                    
            <label>Telefono Abitazione</label>
                <input type="text" name="telefono" size="20">
            <label>Telefono Mobile</label>
                <input type="text" name="telefono_mobile" size="20">
            <label>Email</label>
                <input type="text" name="email" size="20"> 

                <p> Informazioni Residenza <br/>

                    Città: <input type="text" name="residenza_citta" size="20"> 
                    Indirizzo: <input type="text" name="residenza_indirizzo" size="30">
                </p>

                <p> Domicilio diverso <input id="dom" type="checkbox" value=""> </p>

                <p id="domicilio">
                    Città: <input type="text" name="domicilio_citta" size="20"> 
                    Indirizzo: <input type="text" name="domicilio_indirizzo" size="30">
                </p>
                
                 
            
                <p> Tipo Documento:
                    <select name="documento_tipo">
                        <option value="1">Carta Identità</option>
                        <option value="2">Passaporto</option>
                        <option value="3">Patente</option>
                    </select>
                    Numero: <input type="text" name="documento_numero" size="20">
                    Stato di rilascio: <input type="text" name="documento_stato_rilascio" size="30"> 
                    Data di rilascio: <input type="date" name="documento_data_rilascio" >
                    Data di scadenza: <input type="date" name="documento_data_scadenza">
                </p>

                <p> Codice Fiscale: <input type="text" name="codicefiscale" size="20"/>
                    Cittadino extracomunitario: <input name="extra_europeo" value="S"> </p>
                
                
            
                <p> Passaporto <br/>
                    Numero: <input type="text" name="passaporto_numero" size="20">
                    Tipo:
                    <select name="passaporto_tipo">
                        <option value="1">rifuggiato politico</option>
                        <option value="2">motivi umanitari</option>
                        <option value="3">ricongiungimento familiare</option>
                        <option value="4">profugo</option>
                        <option value="5">lavoro subordinato</option>
                        <option value="6">lavoro stagionale</option>
                        <option value="7">libero professionista</option>
                    </select>
                    Stato di rilascio: <input type="text" name="passaporto_stato_rilascio" size="30"> 
                    Data di rilascio: <input type="date" name="passaporto_data_rilascio">
                    Data di scadenza: <input type="date" name="passaporto_data_scadenza">
                </p>
                
               
                <p> Patente <br/>
                    Numero: <input type="text" name="patente_numero" size="20">
                    Tipo:
                    <select name="patente_categoria">
                        <option value="1">A</option>
                        <option value="2">B</option>
                        <option value="3">C</option>
                        <option value="4">D</option>
                        <option value="5">E</option>
                        <option value="6">F</option>
                        <option value="7">G</option>
                    </select>
                    Stato di rilascio: <input type="text" name="patente_stato" size="30"> 
                    Data di rilascio: <input type="date" name="patente_data_rilascio">
                    Data di scadenza: <input type="date" name="patente_data_scadenza">
                </p>
                
                  
                
                <p> Dati Somatici <br/>
                    
                    Numero Figli:
                    <select name="figli_numero">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                        
                    Altezza: <input type="text" name="altezza" size="6">
                    Peso: <input type="text" name="peso" size="6">
                    Capelli: <input type="text" name="capelli" size="10">
                    Occhi: <input type="text" name="occhi" size="10">
                    Lingua Madre: <input type="text" name="lingue" size="20">
                </p>
		
	 
	</div>
	<div class="modal-footer">
		<input type="submit" class="btn btn-primary" value="Crea Dipendente" >
		<button class="btn" data-dismiss="modal" aria-hidden="true">Chiudi</button>
  </div>
  </form>
</div>
    
    <div id="elimina" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel"> Attento </h3>
	</div>
        <div class="modal-body">
            
            <h4>Oh snap! You got an error!</h4>
            <p>Change this and that and try again. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.</p>
            <p>
              <a class="btn btn-danger" href="#">Take this action</a> <a class="btn" href="#">Or do this</a>
            </p>
          </div>
      </div>
</body>
</html>