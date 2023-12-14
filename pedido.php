<?php
session_start();
require_once "funcoes.php";

if(gerarPedido(session_id())){
    include_once "inc/success_pedido.inc";
}else{
    include_once "inc/success_pedido.inc";
}
?>