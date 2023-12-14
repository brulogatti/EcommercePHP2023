<?php
session_start();
require_once "funcoes.php";
if(isset($_SESSION["codigo"])){
    include_once "inc/pedidos.inc";
}else{
    header("Location: user.php");
}
?>