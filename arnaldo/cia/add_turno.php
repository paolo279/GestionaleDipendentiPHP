<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/start/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="../js/bootstrap.js"></script>
<script>
function reloadPage()
  {
  location.reload()
  }

$("#ora").click(function(){
    
    
});
    
</script>
</head>
<body>

<?php 
session_start();


include('../config.php');

require_once '../function.php';

$data= $_GET["day"];
$id=$_GET["id"];





if(IsSet($_GET["add"])){
    
     // se viene inserito un ora di fine antecedente l'ora di inzio da errore
     if(!controlloOraMaggiore($_POST["ora_inizio"], $_POST["ora_fine"]))  header('Location: add_turno.php?errore_inizio_fine&id='.$id.'&day='.$data);
        else{
            //altrimenti controlla che non ci siano sovrapposizioni orarie con i turni
            $controllo=true;
            $controllo2=false;
            $query=  mysql_query("SELECT * FROM `turni` WHERE `data` =  '$data' AND `servizioId` ='$id'");
            while ($row = mysql_fetch_array($query)) {
                $controllo = controllo_orario($_POST["ora_inizio"], $_POST["ora_fine"], $row["ora_inizio"], $row["ora_fine"]);
                
              
            }   
                //se il controllo è ancora true verifiche che il dipendente non lavora in quegli orari e non supera le 8 ore complessive
                if($controllo){
                    $controllo2=true;
                    $sql3=mysql_query("SELECT * FROM `turni` WHERE `data` =  '$data' AND `matricolaId`='".$_POST["dipendente"]."'");
                    
                    $ore=contaOre($_POST["ora_inizio"], $_POST["ora_fine"]);   
                    
                    while ($row = mysql_fetch_array($sql3)) {
                        
                        $controllo2 = controllo_orario($_POST["ora_inizio"], $_POST["ora_fine"], $row["ora_inizio"], $row["ora_fine"]);
                        $ore=$ore + contaOre($row["ora_inizio"], $row["ora_fine"]);
                        }
                        //serve un controllo per il tempo minimo di 1 ora per lo spostamento del dipendente
                }else header('Location: add_turno.php?errore_turno_occupato&id='.$id.'&day='.$data);

                if($controllo2 && $ore<=8){ 
                    
                    $q1=mysql_query("SELECT * FROM  `servizio_esercizio` WHERE  `id` =$id");
                    while ($r2 = mysql_fetch_array($q1)) {
                        
                        $sql=mysql_query("INSERT into turni (servizioId,esercizioId,data,matricolaId,ora_inizio,ora_fine) values 
                    ('".$id."','".$r2["id_esercizio"]."','".$data."','".$_POST["dipendente"]."','".$_POST["ora_inizio"]."','".$_POST["ora_fine"]."')")or die(mysql_error());
                    }
                    
                    
		
                }else{
                    if($controllo && !$controllo2) header('Location: add_turno.php?errore_dip_occupato&id='.$id.'&day='.$data);
                elseif($ore>8) header('Location: add_turno.php?errore_orario_alto&id='.$id.'&day='.$data);
                }
        
            }	 
	}

	
if(IsSet($_GET["del"])){
                $ora_inizio=$_GET["ora_inizio"];
		 $sql=mysql_query("DELETE FROM turni WHERE (servizioId,data,ora_inizio) = 
		 ('".$id."','".$data."','".$ora_inizio."')")or die(mysql_error());
		header('Location: add_turno.php?id='.$id.'&day='.$data);
	}
        
 
?>
    
   


	

	<div class="container">

			<?php 
                        
                            
				
				echo"<h3> Turno ".cercaEsercizio($id)." </h3>
                                     <h4>Data: ".date('j-n-Y',strtotime($data))." </h4>";
                                
				echo "<form class='form' action='add_turno.php?add&id=".$id."&day=".$data."' method='post'>";
				
				echo"<p>Dipendenti Disponibili: <select name='dipendente'>";
				
                                //cerca i dipendenti utilizzati in quel giorno
				$sql=mysql_query("SELECT matricolaId FROM  `turni` WHERE `data` =  '$data'");
				while($q = mysql_fetch_array($sql)){
				$usati[]=$q["matricolaId"];
				}
                                //per ogni utente conta le ore che ha lavorato quel giorno e li salva in un array
                                foreach ($usati as $dipendenti) {
                                    $ore=0;
                                    $sql1=mysql_query("SELECT ora_inizio,ora_fine FROM  `turni` WHERE `data` =  '$data' AND matricolaId= '$dipendenti'");
                                    while ($row1 = mysql_fetch_array($sql1)) {
                                        $ore=$ore +  contaOre($row1["ora_inizio"], $row1["ora_fine"]);
                                      
                               
                                    }
                                    
                                    if($ore>=7) $occupati[]=$dipendenti;
                                }
				//se il dipendente ha lavorato più di 8 ore lo salva in un array e non lo inserisce nel select !
				$query1=mysql_query("SELECT * FROM `dipendenti`");
				while($r = mysql_fetch_array($query1)){
				
					if(!in_array($r["id"], $occupati))
					echo"<option value='".$r["id"]."'>".$r["nome"]." ".$r["cognome"]."</option>";
				
				}
				
				

				echo "</select> </p>";

				?>
            <p>
                Ora inizio: <input type='time' value="<?php echo oraInizio($id); ?>" name="ora_inizio">
                Ora fine: <input type='time' value="<?php echo oraFine($id); ?>" name="ora_fine" >
            </p>
		
            <p>	<input type="submit" class="btn btn-primary" value="Salva Turno" > </p>
            
	</form> 
                
      
	
 
    
    
	<?php
		
               ?>
                
            <div>
                <table class="table table-striped table-condensed">
                    <tr>
                        <th> Dipendente</th>
                        <th> Operatore</th>
                        <th> Orario</th>
                    </tr>
                    
                
                
                <?php
                
                    $sql4=mysql_query("SELECT * FROM `turni` WHERE `data` =  '$data' AND servizioId ='$id'");

			while($res = mysql_fetch_array($sql4)){
                            echo"<tr>";
                                
                            $sql2=mysql_query("SELECT * FROM `dipendenti` WHERE `id` =".$res["matricolaId"])or die(mysql_error());;
				while($resu = mysql_fetch_array($sql2)){
					echo"<td>".$resu["nome"]." ".$resu["cognome"]."</td>";
                                        echo"<td>".$resu["matricola"]."</td>";
					}
                             echo"<td> ".substr_replace($res["ora_inizio"] ,"",-3)." - ".substr_replace($res["ora_fine"] ,"",-3)."</td> ";
                             echo"<td><a href='add_turno.php?del&id=".$id."&day=".$data."&ora_inizio=".$res["ora_inizio"]."'> <button class='btn'> Cancella </button> </a></td>";
                            echo"</tr>";           
			}
                  //  echo "<form action='add_turno.php?upd&id=".$id."&day=".$data."' method='post'>";
                
		?>
                    </table>
  
            </div>
	 
               <?php
    if(IsSet($_GET["errore_dip_occupato"])){
            echo"<div class='alert alert-error'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                <strong>Dipendente occupato in un altro turno !!!</strong>
                </div>";
                }
                
    if(IsSet($_GET["errore_inizio_fine"])){
            echo"<div class='alert alert-error'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                <strong>Attenzione è stato inserito un orario non valido</strong>
                </div>";
                }
                
    if(IsSet($_GET["errore_turno_occupato"])){
            echo"<div class='alert alert-error'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                <strong>Attenzione per l'orario inserito il turno è già coperto</strong>
                </div>";
                }
            ?>
             
           
         
    <p><a href="turni.php"> <button class="btn btn-success"> Esci</button></a></p>
 </div>	
    
   
</body>
</html>