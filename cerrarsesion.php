<?php
session_start();
if(!isset($_SESSION["sn_usuario"])&&!isset($_SESSION["sn_clave"])){
    header("Location: index.php");
}
session_destroy();
header("Location: index.php");

?>