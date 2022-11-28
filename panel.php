<?php

session_start();

#Se verifica que exista una sesion
if(isset($_POST["usuario"])&&isset($_POST["clave"])){
    #se crean las sesiones
    $_SESSION["sn_usuario"] = $_POST["usuario"];
    $_SESSION["sn_clave"] = $_POST["clave"];
}

if(!isset($_SESSION["sn_usuario"])&&!isset($_SESSION["sn_clave"])){
    header("Location: index.php");
}


#Se verifica que esté maracada la opción para guardar la información
#Si no existe cookie se toma el valor del POST
if(!isset($_COOKIE["ck_preferencias"])){
    echo "entre aca arriba";
    $recordarPreferencias = (isset($_POST["chkrecordar"]))?$_POST["chkrecordar"]:"";
}else{  
    #Quiere decir que viene desde el link de los lenguajes
   if(empty($_POST)){
    $recordarPreferencias = $_COOKIE["ck_preferencias"];
   }else{ #Quiere decir que viene de la págian del Login
       
    $recordarPreferencias = (isset($_POST["chkrecordar"]))?$_COOKIE["ck_preferencias"]:"";
   }
}

$archivo = "categorias_es.txt";
$titulo = "Lista de Productos";
$defaultleng = "es";

#Verifica si hay parámetros en el GET
if(empty($_GET)){
     $lenguaje = (isset($_COOKIE["ck_lenguaje"])?$_COOKIE["ck_lenguaje"]:$defaultleng);
}else{
    
     $lenguaje = $_GET["leng"];
       
}

#Se verifica si es necesario cambiar los cookies o borrarlos cuando no esta chequeado guardar preferencias
if($recordarPreferencias!=""){
    setcookie("ck_usuario",$_SESSION["sn_usuario"],time()+(86400)); #se pone el tiempo que dura la cookie en este caso 24 horas
    setcookie("ck_clave",$_SESSION["sn_clave"],time()+(86400)); 
    setcookie("ck_lenguaje",$lenguaje,time()+(86400));
    setcookie("ck_preferencias",$recordarPreferencias,time()+(86400));
}else{
    setcookie("ck_usuario","",time()-(86400)); #se pone el tiempo negativo para borrar la cookie
    setcookie("ck_clave","",time()-(86400)); 
    setcookie("ck_lenguaje","",time()-(86400));
    setcookie("ck_preferencias","",time()-(86400));
}



#Si lenguaje es ingles se cambia el título y el archivo de lectura
if($lenguaje == "en"){
    $archivo = "categorias_en.txt";
    $titulo = "Product List";
}


?>

<!DOCTYPE html>
<html> 
    <head></head>
    <body>
        <h1> PANEL PRINCIPAL </h1>
        <br><br>
        <h2> Bienvenido Usuario: <?php echo $_SESSION["sn_usuario"];  ?> </h2> <br>
        <a href="panel.php?leng=es">ES (Español)</a>|
        <a href="panel.php?leng=en">EN(English)</a><br><br>
        <a href="cerrarsesion.php">Cerrar Sesion</a><br><br>
        <h2><?php echo $titulo ?></h2><br>
        <?php 
         
            $file = fopen($archivo, "r") or die("No se puede abrir el archivo!");
            // Output one character until end-of-file
            while(!feof($file)) {
                echo fgets($file) ."<br>";
            }
            fclose($file);
        
                        
        ?>


    </body>



</html>