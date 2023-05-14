<?php
require_once("config.php");

    if(isset($_POST['NAME']) && isset($_POST['SURN']) && isset($_POST['PW'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $Entername = validate($_POST['NAME']);
        $Entercogn = validate($_POST['SURN']);
        $Enterpw = validate($_POST['PW']);

        if(empty($Entername)){
            header("Location: index.php?error=Name is required");
            exit();
        } else if(empty($Entercogn)){
            header("Location: index.php?error=Surname is required");
            exit();
        } else if(empty($Enterpw)){
            header("Location: index.php?error=Password is required");
            exit();
        } else {
            $q = "SELECT * FROM tutenti WHERE nome = '".$Entername."' AND cognome = '".$Entercogn."' 
            AND password = '".$Enterpw."'";

            $result = mysqli_query($conn, $q);

            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);     
                
                if($row['nome'] === $Entername && $row['cognome'] === $Entercogn && $row['password'] === $Enterpw){
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['cognome'] = $row['cognome'];
                    $_SESSION['idUtente'] = $row['idUtente'];
                    header("Location: risposta.php");
                    exit();
                }else{
                    header("Location: index.php?error=Incorect Name or Surname or Password");
                    exit();
                } 
            } else {
                header("Location: index.php?error=Incorect Name or Surname or Password");
                exit();
            }
        }
    }

?>