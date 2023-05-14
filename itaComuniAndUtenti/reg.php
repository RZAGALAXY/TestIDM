<?php
require_once("config.php");

$nome = $_POST["nome"];
$cognome = $_POST["cognome"];
$password = $_POST["password"];
$dataN = $_POST["dataN"];
$prov = $_POST['prov'];
$comune =  $_POST['comune'];


$q = "SELECT siglaProvincia
      FROM listacomuniitaliani
      WHERE  nomeComune = '".$comune."'";
      $query = mysqli_query($conn, $q);

      while ($row = mysqli_fetch_assoc($query))  $siglPR = $row['siglaProvincia'];

      $query1 = "INSERT INTO `tutenti` (`cognome`, `nome`, `dataNascita`, `password`, `comuneNascita`,`provincia`, `siglaProvincia` ) VALUES
                                 ('".$cognome."', '".$nome."', '".$dataN."', '".$password."', '".$comune."', '".$prov."','".$siglPR."') ";
 
	$alunni = mysqli_query($conn, $query1) or die(mysqli_error($conn)."Errore nella query");

      header("location: index.php");
?>
	

