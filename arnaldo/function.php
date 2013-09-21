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

function turno($id,$day){

		$query=mysql_query("SELECT `matricolaId` FROM  `turni` WHERE  `esercizioId` =$id AND `data` =  '$day'");
		while($q=mysql_fetch_array($query)){
                       $dip= cercaDipendente($q["matricolaId"]);
			$result = "<td style='background-color:lightgreen;'> <a class='turno-link' href='add_turno.php?update&id=".$id."&day=".$day."'> ".$dip["nome"]." ".$dip["cognome"]." </a> </td>";
			return "$result";
		}
                
		$sql=mysql_query("SELECT `giorni_lavorativi` FROM  `esercizi` WHERE  `id` =$id");
                while ($row = mysql_fetch_array($sql)) {
                   $giorni= explode("|", $row["giorni_lavorativi"]); 
                   if(in_array(date('w',strtotime($day)), $giorni)){
                       $result="<td style='background-color:yellow;'> <a class='turno-link' href='add_turno.php?id=".$id."&day=".$day."'> Inserisci turno </a> </td>";
                       return $result;
                   }
                }
		$result="<td style='background-color:hotpink;'> <a class='turno-link' href='add_turno.php?id=".$id."&day=".$day."'> NO SERVIZIO </a> </td>";
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
        
        if(($hour1>=$hour_inizio && $hour1<=$hour_fine) || ($hour2>=$hour_inizio && $hour2<=$hour_fine)){ 
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
