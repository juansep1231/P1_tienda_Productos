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
if(!isset($_COOKIE["ck_preferencias"])){
    echo "entre aca arriba";
    $recordarPreferencias = (isset($_POST["chkrecordar"]))?$_POST["chkrecordar"]:"";
}else{  
    echo "entre aca abajo";
   # $recordarPreferencias = $_COOKIE["ck_preferencias"];
   #Quiere decir que viene desde el link de los lenguajes
   if(empty($_POST)){
    echo "no hay post";
    $recordarPreferencias = $_COOKIE["ck_preferencias"];
   }else{ #Quiere decir que viene del Login
    echo "si hay post";
    var_dump($_POST);
    $recordarPreferencias = (isset($_POST["chkrecordar"]))?$_COOKIE["ck_preferencias"]:"";
   }
}

$archivo = "categorias_es.txt";
$titulo = "Lista de Productos";
$defaultleng = "es";

#Verifica si la variable $_GET está vacía para notar que es un ingreso desde el login.
#Si el ingreso es desde el login es necesario verificar si hay cookies creadas para el idioma o se utiliza el idioma pro defecto
/*if(empty($_GET)){
    var_dump($_GET);
     $lenguaje = (isset($_COOKIE["ck_lenguaje"])?$_COOKIE["ck_lenguaje"]:$defaultleng);
}else if(isset($_COOKIE["ck_lenguaje"])){
    var_dump($_COOKIE);   
     $lenguaje = $_GET["leng"];
       
}*/
if(empty($_GET)){
     $lenguaje = (isset($_COOKIE["ck_lenguaje"])?$_COOKIE["ck_lenguaje"]:$defaultleng);
}else{
    
     $lenguaje = $_GET["leng"];
       
}





/*
if(isset($_COOKIE["ck_lenguaje"])){
    echo "si entre aqui";
    
    $lenguaje = ($_COOKIE["ck_lenguaje"]==$_GET["leng"])?$_COOKIE["ck_lenguaje"]:$_GET["leng"];
    if($lenguaje=="es"){
        $lenguaje = ($_COOKIE["ck_lenguaje"]==$_GET["leng"])?$_GET["leng"]:$_COOKIE["ck_lenguaje"];
    }
    
}else{
    $lenguaje = $_GET["leng"];
}
*/




if($recordarPreferencias!=""){
    echo $lenguaje;
    echo $recordarPreferencias;
    setcookie("ck_usuario",$_SESSION["sn_usuario"],time()+(86400)); #se pone el tiempo que dura la cookie
    setcookie("ck_clave",$_SESSION["sn_clave"],time()+(86400)); #se pone el tiempo que dura la cookie
    setcookie("ck_lenguaje",$lenguaje,time()+(86400));
    setcookie("ck_preferencias",$recordarPreferencias,time()+(86400));
}else{
    setcookie("ck_usuario","",time()-(86400)); #se pone el tiempo que dura la cookie
    setcookie("ck_clave","",time()-(86400)); #se pone el tiempo que dura la cookie
    setcookie("ck_lenguaje","",time()-(86400));
    setcookie("ck_preferencias","",time()-(86400));
}


/*3
if(($_COOKIE["ck_preferencias"])!=($_POST["chkrecordar"])){
    setcookie("ck_usuario","",time()-(86400)); #se pone el tiempo que dura la cookie
    setcookie("ck_clave","",time()-(86400)); #se pone el tiempo que dura la cookie
    setcookie("ck_lenguaje","",time()-(86400));
    setcookie("ck_preferencias","",time()-(86400));
}
*/
#se establece el idioma en caso de que no haya cookies
/*$lenguaje ="";
var_dump($_COOKIE);
if(count($_COOKIE)==1){
    $lenguaje = (empty($_GET))?$defaultleng:$_GET["leng"];
    echo "orale";
}*/

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
                echo fgets($file) . "";
            }
            fclose($file);
        
                        
        ?>


    </body>



</html>