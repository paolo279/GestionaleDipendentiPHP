<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <title></title>
    </head>
    <body>
        <?php
        include '../config.php';
        include_once '../function.php';
        $id=$_GET["id"];
        $dip = cercaDipendente($id);
        
        if(IsSet($_GET["upd"])){
            mysql_query("UPDATE dipendenti SET nome='" . $_POST["nome"] . "',cognome='" . $_POST["cognome"] . "',matricola='" . $_POST["matricola"] . "',tipo='" . $_POST["tipo"] . "',attivo='S',paga='" . $_POST["paga"] . "',telefono='" . $_POST["telefono"] . "',email='" . $_POST["email"] . "'"
                    .",nazionalita='" . $_POST["nazionalita"] . "',luogo_nascita='" . $_POST["luogo_nascita"] . "',data_nascita='" . $_POST["data_nascita"] . "',stato_civile='" . $_POST["stato_civile"] . "'"
                    .",residenza_citta='" . $_POST["residenza_citta"] . "',residenza_indirizzo='" . $_POST["residenza_indirizzo"] . "',domicilio_citta='" . $_POST["domicilio_citta"] . "',domicilio_indirizzo='" . $_POST["domicilio_indirizzo"] . "',telefono_mobile='" . $_POST["telefono_mobile"] . "'"
                    .",documento_tipo='" . $_POST["documento_tipo"] . "',documento_numero='" . $_POST["documento_numero"] . "',documento_stato_rilascio='" . $_POST["documento_stato_rilascio"] . "',documento_data_rilascio='" . $_POST["documento_data_rilascio"] . "',documento_data_scadenza='" . $_POST["documento_data_scadenza"] . "'"
                    .",codicefiscale='" . $_POST["codicefiscale"] . "',extra_europeo='" . $_POST["extra_europeo"] . "',passaporto_numero='" . $_POST["passaporto_numero"] . "',passaporto_tipo='" . $_POST["passaporto_tipo"] . "',passaporto_stato_rilascio='" . $_POST["passaporto_stato_rilascio"] . "',passaporto_data_rilascio='" . $_POST["passaporto_data_rilascio"] . "',passaporto_data_scadenza='" . $_POST["passaporto_data_scadenza"] . "'"
                    .",patente_numero='" . $_POST["patente_numero"] . "',patente_categoria='" . $_POST["patente_categoria"] . "',patente_stato='" . $_POST["patente_stato"] . "',patente_data_rilascio='" . $_POST["patente_data_rilascio"] . "',patente_data_scadenza='" . $_POST["patente_data_scadenza"] . "'"
                    .",figli_numero='" . $_POST["figli_numero"] . "',altezza='" . $_POST["altezza"] . "',peso='" . $_POST["peso"] . "',capelli='" . $_POST["capelli"] . "',occhi='" . $_POST["occhi"] . "',lingue='" . $_POST["lingue"] . "'"
                    ." WHERE id ='".$_GET["id"]."'") or die(mysql_error());
            header('Location: dipendenti.php');
        }
        
        ?>
        
    
     <form action="modifica_dipendente.php?upd&id=<?php echo $dip["id"]; ?>" method="post">
        <div class="modal-header">
            <a class="close" data-dismiss="modal">x</a>
            <h3>Modifica Dipendente</h3>
            </div>
        <div class="modal-body">
           
                <p> Nome: <input type="text" name="nome" value="<?php echo $dip["nome"]; ?>" size="20">
                    Cognome: <input type="text" name="cognome" value="<?php echo $dip["cognome"]; ?>" size="20"> </p>

                <p>	Matricola: <input type="text" name="matricola" value="<?php echo $dip["matricola"]; ?>" size="20">
                    
                    <select name="tipo">
                        <option value="1" <?php if($dip["tipo"]==="1") echo "selected"; ?> >Dipendente</option>
                        <option value="2" <?php if($dip["tipo"]==="2") echo "selected"; ?> >Collaboratore</option>
                    </select>
                </p>
                <p> Telefono: <input type="text" value="<?php echo $dip["telefono"]; ?>" name="telefono" size="20">
                    Cellulare: <input type="text" value="<?php echo $dip["telefono_mobile"]; ?>" name="telefono_mobile" size="20">
                    Email: <input type="text" value="<?php echo $dip["email"]; ?>" name="email" size="20"> 
                </p>
                <p> Nazionalità: <input type="text" value="<?php echo $dip["nazionalita"]; ?>" name="nazionalita" size="20">
                    Città di nascita: <input type="text" value="<?php echo $dip["luogo_nascita"]; ?>" name="luogo_nascita" size="30"> 
                    Data di nascita: <input type="date" value="<?php echo $dip["data_nascita"]; ?>" name="data_nascita">
                    Stato Civile:
                    <select name="stato_civile">
                        <option value="1" <?php if($dip["stato_civile"]==="1") echo "selected"; ?>>Celibe</option>
                        <option value="2"<?php if($dip["stato_civile"]==="2") echo "selected"; ?>>Coniugato</option>
                        <option value="3"<?php if($dip["stato_civile"]==="3") echo "selected"; ?>>Divorziato</option>
                    </select>
                </p>
                
                <p> Informazioni Residenza <br/>

                    Città: <input type="text" name="residenza_citta" value="<?php echo $dip["residenza_citta"]; ?>" size="20"> 
                    Indirizzo: <input type="text" name="residenza_indirizzo" value="<?php echo $dip["residenza_indirizzo"]; ?>" size="30">
                </p>

                <p> Domicilio diverso <input id="dom" type="checkbox" value=""> </p>

                <p id="domicilio">
                    Città: <input type="text" name="domicilio_citta" value="<?php echo $dip["domicilio_citta"]; ?>" size="20"> 
                    Indirizzo: <input type="text" name="domicilio_indirizzo" value="<?php echo $dip["domicilio_indirizzo"]; ?>" size="30">
                </p>
                
                <p> Tipo Documento:
                    <select name="documento_tipo">
                        <option value="1" <?php if($dip["documento_tipo"]==="1") echo "selected"; ?> >Carta Identità</option>
                        <option value="2" <?php if($dip["documento_tipo"]==="2") echo "selected"; ?> >Passaporto</option>
                        <option value="3"  <?php if($dip["documento_tipo"]==="3") echo "selected"; ?> >Patente</option>
                    </select>
                    
                    Numero: <input type="text" name="documento_numero" value="<?php echo $dip["documento_numero"]; ?>" size="20">
                    Stato di rilascio: <input type="text" name="documento_stato_rilascio"  value="<?php echo $dip["documento_stato_rilascio"]; ?>" size="30"> 
                    Data di rilascio: <input type="date" name="documento_data_rilascio" value="<?php echo $dip["documento_data_rilascio"]; ?>">
                    Data di scadenza: <input type="date" name="documento_data_scadenza" value="<?php echo $dip["documento_data_scadenza"]; ?>">
                </p>

                <p> Codice Fiscale: <input type="text" name="codicefiscale" value="<?php echo $dip["codicefiscale"]; ?>" size="20"/></p>
                
                <p>
                Cittadino extracomunitario: 
                    si <input id="showUE" type="radio" name="extra_europeo" <?php if($dip["extra_europeo"]==="S") echo "checked"; ?> value="S">
                    no <input id="hideUE" type="radio" name="extra_europeo" <?php if($dip["extra_europeo"]==="N") echo "checked"; ?> value="N">
  
                </p> 
                
            
                <div id="extraUE"> Dettaglio Passaporto <br/>
                    Numero: <input type="text" name="passaporto_numero" value="<?php echo $dip["passaporto_numero"]; ?>" size="20">
                    Tipo:
                    <select name="passaporto_tipo">
                        <option value="1" <?php if($dip["passaporto_tipo"]==="1") echo "selected"; ?> >rifuggiato politico</option>
                        <option value="2" <?php if($dip["passaporto_tipo"]==="2") echo "selected"; ?> >motivi umanitari</option>
                        <option value="3" <?php if($dip["passaporto_tipo"]==="3") echo "selected"; ?> >ricongiungimento familiare</option>
                        <option value="4" <?php if($dip["passaporto_tipo"]==="4") echo "selected"; ?> >profugo</option>
                        <option value="5" <?php if($dip["passaporto_tipo"]==="5") echo "selected"; ?> >lavoro subordinato</option>
                        <option value="6" <?php if($dip["passaporto_tipo"]==="6") echo "selected"; ?> >lavoro stagionale</option>
                        <option value="7" <?php if($dip["passaporto_tipo"]==="7") echo "selected"; ?> >libero professionista</option>
                    </select>
                    Stato di rilascio: <input type="text" name="passaporto_stato_rilascio" value="<?php echo $dip["passaporto_stato_rilascio"]; ?>" size="30"> 
                    Data di rilascio: <input type="date" value="<?php echo $dip["passaporto_data_rilascio"]; ?>" name="passaporto_data_rilascio">
                    Data di scadenza: <input type="date" name="passaporto_data_scadenza" value="<?php echo $dip["passaporto_data_scadenza"]; ?>" >
                </div>
                
                 <p> Patente  <input id="pat" type="checkbox" value=""></p>
                
                <p id="patente">
                    Numero: <input type="text" name="patente_numero" value="<?php echo $dip["patente_numero"]; ?>" size="20">
                    Tipo:
                    <select name="patente_categoria">
                        <option value="1" <?php if($dip["patente_categoria"]==="1") echo "selected"; ?> >A</option>
                        <option value="2" <?php if($dip["patente_categoria"]==="2") echo "selected"; ?> >B</option>
                        <option value="3" <?php if($dip["patente_categoria"]==="3") echo "selected"; ?> >C</option>
                        <option value="4" <?php if($dip["patente_categoria"]==="4") echo "selected"; ?> >D</option>
                        <option value="5" <?php if($dip["patente_categoria"]==="5") echo "selected"; ?> >E</option>
                        <option value="6" <?php if($dip["patente_categoria"]==="6") echo "selected"; ?> >F</option>
                        <option value="7" <?php if($dip["patente_categoria"]==="7") echo "selected"; ?> >G</option>
                    </select>
                    Stato di rilascio: <input type="text" name="patente_stato" value="<?php echo $dip["patente_stato"]; ?>" size="30"> 
                    Data di rilascio: <input type="date" value="<?php echo $dip["patente_data_rilascio"]; ?>" name="patente_data_rilascio">
                    Data di scadenza: <input type="date" value="<?php echo $dip["patente_data_scadenza"]; ?>" name="patente_data_scadenza">
                </p>
                
                <p> Dati Somatici <br/>
                    
                    Numero Figli:
                    <select name="figli_numero">
                        <option value="0" <?php if($dip["figli_numero"]==="0") echo "selected"; ?>>0</option>
                        <option value="1" <?php if($dip["figli_numero"]==="1") echo "selected"; ?>>1</option>
                        <option value="2" <?php if($dip["figli_numero"]==="2") echo "selected"; ?>>2</option>
                        <option value="3" <?php if($dip["figli_numero"]==="3") echo "selected"; ?>>2</option>
                        <option value="4" <?php if($dip["figli_numero"]==="4") echo "selected"; ?>>2</option>
                        <option value="5" <?php if($dip["figli_numero"]==="5") echo "selected"; ?>>2</option>
                        <option value="6" <?php if($dip["figli_numero"]==="6") echo "selected"; ?>>2</option>
                    </select>
                        
                    Altezza: <input type="text" name="altezza" value="<?php echo $dip["altezza"]; ?>" size="6">
                    Peso: <input type="text" name="peso" value="<?php echo $dip["peso"]; ?>" size="6">
                    Capelli: <input type="text" name="capelli" value="<?php echo $dip["capelli"]; ?>" size="10">
                    Occhi: <input type="text" name="occhi" value="<?php echo $dip["occhi"]; ?>" size="10">
                    Lingua Madre: <input type="text" name="lingue" value="<?php echo $dip["lingue"]; ?>" size="20">
                    Paga ora: <input type="text" name="paga" value="<?php echo $dip["paga"]; ?>" size="6">
                </p>
            
        </div>
        <div class="modal-footer">
            <input type="submit" class="btn btn-primary" value="Salva modifiche" >
            <a class="btn" data-dismiss="modal" onclick="$('.modal').remove();">Close</a>
        </div>
        </form> 
    </body>
</html>
