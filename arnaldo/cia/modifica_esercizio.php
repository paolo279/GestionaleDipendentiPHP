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
        
        <h2> Modifica Esercizio </h2>
        <?php
        include '../config.php';
        include_once '../function.php';
        $id=$_GET["id"];
        
        if(IsSet($_GET["upd"])){
            
            $giorni= implode("|", $_POST["giorni"]);
            
            
            mysql_query("UPDATE esercizi SET nome='". $_POST["nome"] ."',cliente='". $_POST["cliente"] ."',citta='". $_POST["citta"] ."',indirizzo='". $_POST["indirizzo"] ."',
                cap='". $_POST["cap"] ."',telefono='". $_POST["telefono"] ."',fax='". $_POST["fax"] ."',email='". $_POST["email"]."',responsabile='". $_POST["responsabile"] ."',tipo_servizio='". $_POST["tipo_servizio"] ."',
                giorni_lavorativi='". $_POST["giorni_lavorativi"] ."',ora_inizio='". $_POST["ora_inizio"] ."',ora_fine='". $_POST["ora_fine"]."'
                WHERE id ='".$_GET["id"]."'") or die(mysql_error());
            header('Location: esercizi.php');
        }
        
        $query = mysql_query("SELECT * from esercizi WHERE id='$id'");
        while($res = mysql_fetch_array($query)){
            $q = $res;
        }
        ?>
        
        <div>
            <form action="modifica_esercizio.php?upd&id=<?php echo $id; ?>" method="post">
		<p> Marchio: <input type="text" name="nome" value="<?php echo $q["nome"]; ?>" size="30">
                    Cliente: <select name="cliente">
			
				<?php 
					$q1 = mysql_query("SELECT * from clienti");
					while($r = mysql_fetch_array($q1)){
                                        if($r["id"]===$q["cliente"]){
                                            echo"<option value='".$r["id"]."' selected>".$r["nome"]."</option>";
                                        }else
					echo"<option value='".$r["id"]."'>".$r["nome"]."</option>";}
				?>
				
				</select>
                </p>
			
		<p> 
                    Città: <input type="text" name="citta" value="<?php echo $q["citta"]; ?>" size="20">
                    Indirizzo: <input type="text" name="indirizzo" value="<?php echo $q["indirizzo"]; ?>" size="30">
                    Cap: <input type="text" name="cap" value="<?php echo $q["cap"]; ?>" size="6">
		</p>
                
                <p> 
                    Telefono: <input type="text" name="telefono" value="<?php echo $q["telefono"]; ?>" size="10">
                    Fax: <input type="text" name="fax" value="<?php echo $q["fax"]; ?>" size="10">
                    Email: <input type="text" name="email" value="<?php echo $q["email"]; ?>" size="20">
		</p>
                
		<p> 
                    Responsabile: <input type="text" name="responsabile" value="<?php echo $q["responsabile"]; ?>" size="20">
                    Tipologia Servizio: <input type="text" name="tipo_servizio" value="<?php echo $q["tipo_servizio"]; ?>" size="40">
		</p>
                
                <p>
                    Giorni Lavorativi:
                    <select multiple name='giorni[]' >
                        <option value="1" <?php if(strpos($q["giorni_lavorativi"], "1") !== false) echo "selected"; ?> >Lunedì</option>
                        <option value="2" <?php if(strpos($q["giorni_lavorativi"], "2") !== false) echo "selected"; ?> >Martedi</option>
                        <option value="3" <?php if(strpos($q["giorni_lavorativi"], "3") !== false) echo "selected"; ?> >Mercoledì</option>
                        <option value="4" <?php if(strpos($q["giorni_lavorativi"], "4") !== false) echo "selected"; ?> >Giovedì</option>
                        <option value="5" <?php if(strpos($q["giorni_lavorativi"], "5") !== false) echo "selected"; ?> >Venerdì</option>
                        <option value="6" <?php if(strpos($q["giorni_lavorativi"], "6") !== false) echo "selected"; ?> >Sabato</option>
                        <option value="0" <?php if(strpos($q["giorni_lavorativi"], "0") !== false) echo "selected"; ?> >Domenica</option>
                    </select>
                    
                    Ora inizio: <input type="time" step="300" value="<?php echo $q["ora_inizio"]; ?>" name="ora_inizio">
                    Ora fine: <input type="time" step="300" value="<?php echo $q["ora_fine"]; ?>" name="ora_fine">
                </p>
		
		<p>	<input type="submit" value="Salva Modifiche" > </p>
            </form> 
	
        </div>
    </body>
</html>
