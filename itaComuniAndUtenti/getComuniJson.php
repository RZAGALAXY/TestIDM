<?php
require_once("config.php");

$idProvince=$_POST["idProvince"];
$province=$_POST["province"];
//echo $idRegione. ' '.$regione.'<br>';
$sqlComuni = "SELECT idComune, nomeComune
                        FROM listacomuniitaliani 
                        WHERE siglaProvincia='".$idProvince."';";
					//INNER JOIN province ON listacomuniitaliani.siglaProvincia = province.siglaProvincia	 
$recordSetCom = mysqli_query($conn, $sqlComuni) or die("Errore: ".mysqli_error($conn));   
mysqli_close($conn);

$jsonarray= array();
while ($rowComune = mysqli_fetch_assoc($recordSetCom))  
	array_push($jsonarray, $rowComune);
echo json_encode($jsonarray); 	

?>