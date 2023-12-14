<?php
require_once "funcoes.php";

if(isset($_GET["codigo"])){
    if(deleteUser($_GET["codigo"])){
        setcookie("deleteUser", "true", time()+60*3);
    }else{
        setcookie("deleteUser", "false", time()+60*3);
    }
}

header("Location: listar_usuarios.php");
?>