<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
<link rel = "stylesheet" href = "../styles.css" type = "text/css" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/start/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script language="JavaScript">
function apri(url) {
var windowprops = "width= 600 ,height= 400";
popup = window.open(url,'remote',windowprops);
}

function confermaServizio(url) {
var r=confirm("In questo giorno non c'è il servizio, continuare comunque ?");
if (r==true)
  {
  window.location.assign(url);
  }
} 

function popup(url) {	
var tag = $("<div></div>");
  $.ajax({
    url: url,
    success: function(data) {
      tag.html(data).dialog({
		modal: true,
		title:"Gestisci Turno",
		position: { my: "center bottom", at: "center top"},
		width: 1024,
		height: 576,
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

require_once '../function.php';



if(IsSet ($_GET["mese"])){
		$mese=$_GET["mese"];
		$anno=$_GET["anno"];
	}else{
		$mese=date("m");
		$anno=date("y");
	}
	


?>

<body>



<div style="float:center; ">	
<h2> Gestione dei Turni </h2>
<p>	<form action="turni.php" method="get">		
		<?php
		echo "Data: <select name='mese'>";
		for ($i = 1; $i <= 12; $i++) {
			if($i==$mese) echo "<option selected value='$i'> $i</option>";
			else echo "<option value='$i'> $i</option>";
			}
		echo"</select>
			<select name='anno'>";
			
		for ($i = 2013; $i <= 2030; $i++) {
			if($i==$anno) echo "<option selected value='$i'> $i</option>";
			else echo "<option value='$i'> $i</option>";
			}
                echo"</select>";
		?>
		<input type="submit" value="Cambia"/>
	</form>
         <table class='turni' >
	<?php
	
	// crea un array di giorni della settimana e cerca il primo luned�
	$giorni=array('Dom','Lun','Mar','Mer','Gio','Ven','Sab');
	//$tmsp = strtotime("this Monday");
	//$days=date('d',$tmsp);
	
	$day_total = cal_days_in_month(CAL_GREGORIAN, $mese, $anno);
	 
	$query = mysql_query("SELECT * FROM  `servizio_esercizio` ORDER BY  `servizio_esercizio`.`id_esercizio` ASC ");
	$i=0;
	echo "<tr> 
			<td> data </td>";	
				
	while($q = mysql_fetch_array($query)){
		$output[$i]=$q["id"];
                $output2[$i]=$q["id_esercizio"];
		echo" <th> <b>".$q["nome_esercizio"]." - ".$q["tipo_servizio"]." </b></th>";
		$i++;
		}
		
	echo "</tr>";	
	
	$day=1;
	while($day<=$day_total){
		//echo "<tr> <td>".$giorni[$day]." ".($days+$day)."/".date("m")."</td>";
		echo "<tr> <td>". $giorni[date('w',strtotime("$anno-$mese-".$day))]." ".($day)."/".$mese."</td>";
		$j=0;
		
		while($j<$i){
			echo turno($output[$j],$output2[$j],"$anno-$mese-$day"); 
			$j++;
			}
			
		$day++;
		}
	
	
	?>
	</table>
	
	
	
</div>


</body>
</html>