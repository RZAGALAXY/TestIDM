<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "itaComuni";
    $conn=mysqli_connect($host,$user,$password,$db) or die("Connessione al server non riuscita.");
	mysqli_query($conn, "set names 'utf8'");   //elimina i problemi con i caratteri accentati obbligando MySQL ad usare la codifica UTF-8
?>