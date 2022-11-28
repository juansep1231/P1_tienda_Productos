<?php 

$usuario="";
$clave="";
$recordar = false;

if(isset($_COOKIE["ck_preferencias"]) && $_COOKIE["ck_preferencias"]!=""){
    $recordar = true;
    $usuario = isset($_COOKIE["ck_usuario"])?$_COOKIE["ck_usuario"]:"";
    $clave = isset($_COOKIE["ck_clave"])?$_COOKIE["ck_clave"]:"";   
}

?>


<!DOCTYPE html>
<html>

    <head>  </head>
    <body>
        <h1> LOGIN </h1>
        <form method = "POST" action = "panel.php">
            <fieldset>
                Usuario*:<br>
                <input type = "text" name = "usuario" required value= <?php echo $usuario;?>><br>
                Clave*:<br>
                <input type = "password" name = "clave" required value= <?php echo $clave;?>><br> 
                <input type =  "checkbox" name = "chkrecordar" <?php echo ($recordar)?"checked":"";?>> Recordarme
                <input type = "submit" value = "Enviar">

            </fieldset> 



        </form>




    </body>





</html>