<?php
require_once "funcoes.php";

if(isset($_GET["id"])){
    if(deletePedido($_GET["id"])){
        setcookie("deletePedido", "true", time()+60*3);
    }else{
        setcookie("deletePedido", "false", time()+60*3);
    }
}

header("Location: listar_pedidos.php");
?>