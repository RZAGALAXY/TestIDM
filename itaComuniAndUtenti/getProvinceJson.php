<?php
require_once("config.php");

$idRegione=$_POST["idRegion"];
$regione=$_POST["region"];
//echo $idRegione. ' '.$regione.'<br>';
$sqlProvince = "SELECT nomeProvincia, siglaProvincia
                        FROM province 
                        WHERE codRegione=".$idRegione.";";
						 
$recordSetProv = mysqli_query($conn, $sqlProvince) or die("Errore: ".mysqli_error($conn));   
mysqli_close($conn);

$jsonarray= array();
while ($rowProvincia = mysqli_fetch_assoc($recordSetProv))  
	array_push($jsonarray, $rowProvincia);
echo json_encode($jsonarray); 	

?>