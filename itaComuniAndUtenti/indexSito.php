<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="welcome.css">
    <script>  
        $(document).ready(function() {
            $("#regione").change(function(){

                //$('#province option').remove();
                $('#province option').each(function() {if ($(this).val()!='-1') $(this).remove();  }); //rimuove tutte le opt precedenti esclusa la prima
                reg=$('#regione :selected').text();
                idReg=$('#regione').val();
                //alert(idReg+' '+reg);
                $.ajax({
                    type: 'POST',  
                    url: "getProvinceJson.php", 
                    dataType: "json",
                    //contentType: "application/json",
                    data: {idRegion: idReg ,region: reg} ,  
                    success:function(data,stat)
                        {   
                            for(res in data) {
                                $('#province').append("<option value='"+data[res].siglaProvincia+"'>"+data[res].nomeProvincia+"</option>");
                            };
                        },
                error:  function(richiesta,stato)
                        {
                            errore =  "<b>AJAX fallita:</b><br>"+richiesta.status+" "+stato;
                        alert("Si è verificato un errore."+errore);
                        }
                    });
                });
            });

            $(document).ready(function() {
                $("#province").change(function(){

                //$('#province option').remove();
                $('#comune option').each(function() {if ($(this).val()!='-1') $(this).remove();  }); //rimuove tutte le opt precedenti esclusa la prima
                prov=$('#province :selected').text();
                idProv=$('#province').val();
                //alert(idReg+' '+reg);
                $.ajax({
                    type: 'POST',  
                    url: "getComuniJson.php", 
                    dataType: "json",
                    //contentType: "application/json",
                    data: {idProvince: idProv ,province: prov} ,  
                    success:function(data,stat)
                        {   
                            for(res in data) {
                                $('#comune').append("<option value='"+data[res].idComune+"'>"+data[res].nomeComune+"</option>");
                            };
                        },
                error:  function(richiesta,stato)
                        {
                            errore =  "<b>AJAX fallita:</b><br>"+richiesta.status+" "+stato;
                        alert("Si è verificato un errore."+errore);
                        }
                });
                });
            });

            function send() {
                nome = $("#nome").val();
                cognome = $("#cogn").val();
                password = $("#pass").val();
                Ripassword = $("#Ripass").val();
                dataN = $("#dataN").val();
                prov = $("#province :selected").text();
                comune = $("#comune :selected").text();

                if(password == Ripassword && password.length > 6){
                    console.log("ci sono");
                    $.ajax({
                    type: 'POST',  
                    url: "reg.php", 
                    dataType: "json",
                    data: {nome: nome ,cognome: cognome,password: password,dataN: dataN,prov: prov,comune: comune} ,  
                    success:function(data,stat)
                        {     
                            for(res in data) {
                                header("location:index.php"); 
                            };
                        },
                });
                } else alert("Re-type password / Incorrect");

           
            }
    </script>
</head>
<body>
<?php
    require_once("config.php");
    $query = "SELECT idRegione, nomeRegione FROM regioni WHERE 1";
    $recordSet = mysqli_query($conn,$query) or die("Errore: ".mysqli_error($conn));
    mysqli_close($conn);
?>
    <!--   cambia aut.php l'username è composto da cognome.nome    -->
    <form method="post">     <!--   Modifica con POST / Lo uso al massimo per fare un login diretto alla pagina    -->
        <h2>Register</h2>
        <?php  if(isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php  }  ?>
        <label>Nome</label>
        <input type="text" name="nome" id="nome" placeholder="Nome"> <br>
        <label>Cognome</label>
        <input type="text" name="cogn" id="cogn" placeholder="Cognome"> <br>
        <label>Password</label>
        <input type="password" name="pass" id="pass" placeholder="Password"> <br>
        <label>Ripeti Password</label>
        <input type="password" name="Ripass" id="Ripass" placeholder="Ripeti Password"> <br>
        <label>Data di Nascita</label>
        <input type="date" name="dataN" id="dataN" id="dataN"> <br>
        <label>Regione</label>
        <select id="regione" name="regione" style='width:140px'>
		<?php
		  echo "<option value='-1'>Seleziona la Regione</option> ";
		  while ($row = mysqli_fetch_assoc($recordSet))
				echo "<option value='".$row['idRegione']."'>".$row['nomeRegione']."</option>";
		?>
	</select> <br><br>
         <!--   combobox    -->
        <label>Provincia</label>
        <select id="province" name="province" style='width:140px'>  
		<option value='-1'>Seleziona la Provincia</option>    
	</select> <br><br>
         <!--   combobox    -->
         <label>Comune</label> 
              
         <select id="comune" name="comune" style='width:140px'>  
		<option value='-1'>Seleziona il Comune</option>  
         <!--   combobox    -->
        </select>
    <button type="submit" onclick="send()"> <a href="index.php">Register</a> </button> 
</form>
</body>
</html>