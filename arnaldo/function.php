<?php
 
function cercaDipendente($id){
	$sql=mysql_query("SELECT * FROM  `dipendenti` WHERE  `id` =$id");
	while($r=mysql_fetch_array($sql)){
		return $r;
	}
}

function trovacliente($id){

$query = mysql_query("SELECT nome from clienti WHERE id='$id'");

$cliente=null;

while($q = mysql_fetch_array($query)){
	$cliente= $q["nome"];
	}
	
	return $cliente;
}

//disegna il calendario con i turni
function turno($id,$day){
    
                $i=0;
                //se il turno è stato inserito scrive il dettaglio e colora la casella di verde
		$query=mysql_query("SELECT * FROM  `turni` WHERE  `esercizioId` =$id AND `data` =  '$day'");
		while($q=mysql_fetch_array($query)){
                        $i=1;
                       $anagrafica= cercaDipendente($q["matricolaId"]);
                       $dip[]= date('G:i',strtotime($q["ora_inizio"]))." - ".date('G:i',strtotime($q["ora_fine"]))." ".$anagrafica["cognome"]." / ";
			
		}
                
                //se ha trovato una corrispondenza e i =1 stampa il risultato
                if($i===1){
                    
                    $result = "<td style='background-color:lightgreen;'> <a class='turno-link' href='add_turno.php?id=".$id."&day=".$day."'>";
                    
                    foreach ($dip as $dip) {
                        $result=$result.$dip;
                    }
                    $result=substr_replace($result, " ", -2);
                    $result = $result." </a> </td>";
                   
                    return "$result";
                }
                
                //se il turno è ancora da inserire, colora la casella di giallo
		$sql=mysql_query("SELECT `giorni_lavorativi` FROM  `esercizi` WHERE  `id` =$id");
                while ($row = mysql_fetch_array($sql)) {
                   $giorni= explode("|", $row["giorni_lavorativi"]); 
                   if(in_array(date('w',strtotime($day)), $giorni)){
                       $result="<td style='background-color:yellow;'> <a class='turno-link' href='add_turno.php?id=".$id."&day=".$day."'> Inserisci turno </a> </td>";
                       return $result;
                   }
                }
                
                //se non trova un risultato dei record scrive NO SERVIZIO
		$result="<td style='background-color:hotpink;'> <a class='turno-link' href='Javascript:confermaServizio(\"add_turno.php?id=".$id."&day=".$day."\");'> NO SERVIZIO </a> </td>";
		return $result;
}

function cercaEsercizio($id){
	$sql=mysql_query("SELECT * FROM  `esercizi` WHERE  `id` =$id");
	while($r=mysql_fetch_array($sql)){
		$result=$r["nome"];
		return $result ;
	}
	
	return null;
}


function oraInizio($id){
    $query=mysql_query("SELECT * FROM  `esercizi` WHERE  `id` =$id");
    while ($row = mysql_fetch_array($query)) {
        
       $result= $row["ora_inizio"];
        return $result ;
    }
    
    return null;
}

function oraFine($id){
    $query=mysql_query("SELECT ora_fine FROM esercizi WHERE id = $id");
    while ($row = mysql_fetch_array($query)) {
        
        $result=$row["ora_fine"];
        return $result ;
    }
    
    return null;
}

//controlla che due orari non si sovrappongono
function controllo_orario($orario1,$orario2,$inizio,$fine){ 
    
        $time_orario1=explode(':',$orario1); 
        $hour1=(int)$time_orario1[0]; 
        //$minute1=(int)$ime_orario1[1]; 
        
        $time_orario2=explode(':',$orario2); 
        $hour2=(int)$time_orario2[0]; 
        //$minute2=(int)$ime_orario2[1]; 
        
        $time_inizio=explode(':',$inizio); 
        $hour_inizio=(int)$time_inizio[0]; 
        //$minute_inizio=(int)$ime_inizio[1]; 
        
        $time_fine=explode(':',$fine); 
        $hour_fine=(int)$time_fine[0]; 
        //$minute_fine=(int)$ime_fine[1];
        
        if(($hour1>=$hour_inizio && $hour1<$hour_fine) || ($hour2>=$hour_inizio && $hour2<=$hour_fine)){ 
           /* if($hour==7){ 
                if($minute<30){ 
                    $output=false; 
                }else{ 
                    $output=true; 
                } 
            }else{ 
                $output=true; 
            } 
        }else{ */
            return false; 
        } 

        
        if($hour1<=$hour_inizio && $hour2>=$hour_fine){
            return false;
        }
    
        return true; 
    } 

    function controlloOraMaggiore($orario1,$orario2){ 
         $time_orario1=explode(':',$orario1); 
        $hour1=(int)$time_orario1[0]; 
        //$minute1=(int)$ime_orario1[1]; 
        
        $time_orario2=explode(':',$orario2); 
        $hour2=(int)$time_orario2[0]; 
       // $minute2=(int)$ime_orario2[1]; 
        
        if($hour1>=$hour2) return false;
        
        return true;
        
    } 
    
    // restituisce l'intervallo di ore tra due orari
     function contaOre($orario1,$orario2){ 
        $time_orario1=explode(':',$orario1); 
        $hour1=(int)$time_orario1[0]; 
        $minute1=(double)$time_orario1[1]/60; 
        
        $time_orario2=explode(':',$orario2); 
        $hour2=(int)$time_orario2[0]; 
        $minute2=(double)$time_orario2[1]/60; 
        
        return (double) ($hour2+$minute2)-($hour1+$minute1);
        
    } 
    
   
?>
