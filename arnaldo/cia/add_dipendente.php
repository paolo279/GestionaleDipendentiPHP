<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script language="JavaScript">

            $(document).ready(function(){
                $("#extraUE").hide();
                $("#domicilio").hide();
                $("#patente").hide();
                
               $("#hideUE").click(function(){
                  $("#extraUE").slideUp("slow");
                });
            
            $("#showUE").click(function(){
                $("#extraUE").slideDown("slow");
             });
             
             $("#dom").click(function(){
             if($(this).is(':checked')){
                 $("#domicilio").slideDown("slow");
             }else $("#domicilio").slideUp("slow");

             });
             
             $("#pat").click(function(){
             if($(this).is(':checked')){
                 $("#patente").slideDown("slow");
             }else $("#patente").slideUp("slow");

             });
            });
        </script>
    </head>

    <?php
    session_start();

    include('../config.php');
    require_once '../function.php';

    if (IsSet($_GET["add"])) {

        if (IsSet($_POST["nome"]) && IsSet($_POST["cognome"]) && IsSet($_POST["matricola"]) && IsSet($_POST["telefono"]) && IsSet($_POST["email"])) {

        if(IsSet($_POST["attivo"])) {$attivo = "S";} else $attivo = "N";
        
             mysql_query("INSERT into dipendenti (nome,cognome,matricola,tipo,tipologia,attivo,paga,telefono,email"
                    .",nazionalita,luogo_nascita,data_nascita,stato_civile"
                    .",residenza_citta,residenza_indirizzo,residenza_cap,domicilio_citta,domicilio_indirizzo,domicilio_cap,telefono_mobile"
                    .",documento_tipo,documento_numero,documento_stato_rilascio,documento_data_rilascio,documento_data_scadenza"
                    .",codicefiscale,data_inizio_rapporto,data_fine_rapporto,extra_europeo,passaporto_numero,passaporto_tipo,passaporto_stato_rilascio,passaporto_data_rilascio,passaporto_data_scadenza"
                    .",permesso_numero,permesso_data_rilascio,permesso_data_scadenza,patente_numero,patente_categoria,patente_stato,patente_data_rilascio,patente_data_scadenza"
                    .",figli_numero,altezza,peso,capelli,occhi,lingue"
                    .") VALUES ('" . $_POST["nome"] . "','" . $_POST["cognome"] . "','" . $_POST["matricola"] . "','" . $_POST["tipo"] . "','" . $_POST["tipologia"] .  "','".$attivo."','" . $_POST["paga"] . "','" . $_POST["telefono"] . "','" . $_POST["email"] . "',"
                    ."'" . $_POST["nazionalita"] . "','" . $_POST["luogo_nascita"] . "','" . $_POST["data_nascita"] . "','" . $_POST["stato_civile"] . "','" . $_POST["residenza_citta"] . "','" . $_POST["residenza_indirizzo"] . "','" . $_POST["residenza_cap"] . "',"
                    ."'" . $_POST["domicilio_citta"] . "','" . $_POST["domicilio_indirizzo"] . "','" . $_POST["domicilio_cap"] . "','" . $_POST["telefono_mobile"] . "','" . $_POST["documento_tipo"] . "','" . $_POST["documento_numero"] . "','" . $_POST["documento_stato_rilascio"] . "',"
                    ."'" . $_POST["documento_data_rilascio"] . "','" . $_POST["documento_data_scadenza"] . "','" . $_POST["codicefiscale"] . "','" . $_POST["data_inizio_rapporto"] . "','" . $_POST["data_fine_rapporto"] .  "','" . $_POST["extra_europeo"] . "','" . $_POST["passaporto_numero"] . "','" . $_POST["passaporto_tipo"] . "',"
                    ."'" . $_POST["passaporto_stato_rilascio"] . "','" . $_POST["passaporto_data_rilascio"] . "','" . $_POST["passaporto_data_scadenza"] . "','" . $_POST["permesso_numero"] .  "','" . $_POST["permesso_data_rilascio"] .  "','" . $_POST["permesso_data_scadenza"] .  "','" . $_POST["patente_numero"] . "','" . $_POST["patente_categoria"] . "','" . $_POST["patente_stato"] . "',"
                    ."'" . $_POST["patente_data_rilascio"] . "','" . $_POST["patente_data_scadenza"] . "','" . $_POST["figli_numero"] . "','" . $_POST["altezza"] . "','" . $_POST["peso"] . "','" . $_POST["capelli"] . "','" . $_POST["occhi"] . "','". $_POST["lingue"]
                    . "')") or die(mysql_error());
            header('Location: dipendenti.php');
        } else
            header('Location: add_dipendente.php?errore');
    }
   
    ?>

    <body>


        <div class="container">
            <h3> Aggiungi un dipendente </h3>

            <form action="add_dipendente.php?add" method="post">
                
                <p>Dipendente operativo: <input type="checkbox" name="attivo" value="S"></p>
                <p> Nome: <input type="text" name="nome" size="20">
                    Cognome: <input type="text" name="cognome" size="20"> </p>
                
                 <p> Telefono: <input type="text" name="telefono" size="20">
                    Cellulare: <input type="text" name="telefono_mobile" size="20">
                    Email: <input type="text" name="email" size="20"> 
                </p>
                <p> Nazionalità: <input type="text" name="nazionalita" size="20">
                    Città di nascita: <input type="text" name="luogo_nascita" size="30"> 
                    Data di nascita: <input type="date" name="data_nascita" >
                    Stato Civile:
                    <select name="stato_civile">
                        <option value="1">Celibe</option>
                        <option value="2">Coniugato</option>
                        <option value="3">Divorziato</option>
                    </select>
                    
                    Numero Figli:
                    <select name="figli_numero">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </p>

                <p>	Operatore: <input type="text" name="matricola" size="20">
                    Contratto:
                    <select name="tipo">
                        <option value="1">Dipendente a tempo indeterminato</option>
                        <option value="2">Dipendente a tempo determinato</option>
                        <option value="3">Collaboratore</option>
                    </select>
                    
                   Tipologia: <select name="tipologia">
                        <option value="1">Full Time </option>
                        <option value="2">Part Time</option>
                       
                    </select>
                </p>
                <p>
                    Inzio rapporto: <input type="date" name="data_inizio_rapporto" >
                    Fine rapporto: <input type="date" name="data_fine_rapporto" >
                    Paga ora: <input type="text" name="paga" size="6">
                </p>
               

                <p> Informazioni Residenza <br/>

                    <label>Città</label> <input type="text" name="residenza_citta" size="20"> 
                    <label>Indirizzo</label> <input type="text" name="residenza_indirizzo" size="30">
                    <label>CAP</label> <input type="text" name="residenza_cap" size="6">
                    
                    
                </p>

                <p> Domicilio <input id="dom" type="checkbox" value=""> </p>

                <p id="domicilio">
                    Città: <input type="text" name="domicilio_citta" size="20"> 
                    Indirizzo: <input type="text" name="domicilio_indirizzo" size="30">
                    CAP: <input type="text" name="domicilio_cap" size="6">
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

                <p> Codice Fiscale: <input type="text" name="codicefiscale" size="20"/></p>
                    
                <p>
                Cittadino extracomunitario: 
                    si <input id="showUE" type="radio" name="extra_europeo" value="S">
                    no <input id="hideUE" type="radio" name="extra_europeo" value="N">
  
                </p> 
                
            
                <div id="extraUE"> 
                    <p>Dettaglio Passaporto <br/>
                    Numero: <input type="text" name="passaporto_numero" size="20">
                    Stato di rilascio: <input type="text" name="passaporto_stato_rilascio" size="30"> 
                    Data di rilascio: <input type="date" name="passaporto_data_rilascio">
                    Data di scadenza: <input type="date" name="passaporto_data_scadenza">
                    </p>
                    
                    <p>
                        Permesso di Soggiorno: <br>
                        Numero: <input type="text" name="permesso_numero" size="20">
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
                        Data di rilascio: <input type="date" name="permesso_data_rilascio">
                        Data di scadenza: <input type="date" name="permesso_data_scadenza">
                        
                    </p>
                    
                </div>
                
               
                <p> Patente  <input id="pat" type="checkbox" value=""></p>
                
                <p id="patente">
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
                    
                    
                        
                    Altezza: <input type="text" name="altezza" size="6">
                    Peso: <input type="text" name="peso" size="6">
                    Capelli: <input type="text" name="capelli" size="10">
                    Occhi: <input type="text" name="occhi" size="10">
                    Lingua Madre: <input type="text" name="lingue" size="20">
                    
                </p>
                
                
              
                <p>	<input type="submit" class="btn btn-primary" value="Aggiungi Utente" > </p>
            </form>
 
 
        </div>

    </body>
</html>


