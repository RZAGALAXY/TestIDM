<!DOCTYPE html>
<html lang="en">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="welcome.css">
</head>
<body>
<?php
    require_once("config.php");
    $query = "SELECT idRegione, nomeRegione FROM regioni WHERE 1";
    $recordSet = mysqli_query($conn,$query) or die("Errore: ".mysqli_error($conn));
    mysqli_close($conn);
?>
    <form action="auth.php" method="POST">
        <h2>Login</h2>
        <?php  if(isset($_GET['error'])) { ?>
            <p class="error">
                <?php echo $_GET['error']; ?>
                <br><br>Per Registrarti <a href="indexSito.php">Clicca qui</a>
        </p>
        <?php  }  ?>
        <label>Nome</label>
        <input type="text" name="NAME" placeholder="Nome"> <br>
        <label>Cognome</label>
        <input type="text" name="SURN" placeholder="Cognome"> <br>
        <label>Password</label>
        <input type="password" name="PW" placeholder="Password"> <br>
    <button type="submit">Login</button> 
</form>
</body>
</html>

