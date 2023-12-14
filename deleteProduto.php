<?php
require_once "funcoes.php";

if(isset($_GET["codigo"])){
    if(deleteProduto($_GET["codigo"])){
        setcookie("deleteProduto", "true", time()+60*3);
    }else{
        setcookie("deleteProduto", "false", time()+60*3);
    }
}

header("Location: dashboard.php");
?>