<html>
<head>
</head>

<?php 
session_start();
?>

<body>

<?php 
include('../config.php');
$id = $_GET["id"];


$query=mysql_query("SELECT * FROM  `dipendenti` WHERE  `id` =".$id)or die(mysql_error());

while($q=mysql_fetch_array($query)){
echo "<div class='modal-header'>
        <a class='close' data-dismiss='modal' >x</a>
        <h3 id='myModalLabel'> Dettaglio Matricola: ".$q['matricola']." </h3>
      </div>
      <div class='modal-body'>";



	echo"<p> <b>Nome: </b> ".$q["nome"]."</p>
		 <p> <b>Cognome: </b> ".$q["cognome"]."</p>
		 <p> <b>Matricola: </b> ".$q["matricola"]."</p>
		 <p> <b>Telefono: </b> ".$q["telefono"]."</p>
		 <p> <b>Email: </b> ".$q["email"]."</p>
		 <p> <a class='btn btn-primary' href='scheda_casermaggio.php?id=".$id."'> Scheda Casermaggio </a> <a href=''> <button> Elimina </button> </a> </p>";
}

    
    echo "</div>";
?>

    <div class="modal-footer">
            <a class="btn btn-primary" onclick="$('.modal-body > form').submit();">Save Changes</a>
            <a class="btn" data-dismiss="modal" onclick="$('.modal').remove();">Close</a>
        </div>

</body>
</html>