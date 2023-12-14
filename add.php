<?php
session_start();
require_once "funcoes.php";
if(isset($_GET)){
    adicionarCarrinho($_GET["codigo"], session_id());
}
header("Location: carrinho.php");
?>