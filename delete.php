<?php
session_start();
require_once "funcoes.php";
if(isset($_GET["codigo"])){
    deletarProdutoCarrinho($_GET["codigo"]);
}

header("Location: carrinho.php");
?>