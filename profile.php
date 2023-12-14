<?php
session_start();
if(isset($_SESSION["codigo"])){
    require_once "funcoes.php";
    include_once "inc/profile.inc";
}else{
    header("Location: user.php");
}
?>
