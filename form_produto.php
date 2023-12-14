<?php
session_start();
require_once "funcoes.php";
if (isset($_SESSION) && $_SESSION["admin"]) {
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_COOKIE["editarProduto"])){
            $result = editarProduto($_COOKIE["editarProduto"]);
            setcookie("editarProduto",$result,2*60*60);
            header("Location: dashboard.php");
        }
        else{
        if(cadastrarProduto()){
            echo '<script>alert("Produto cadastrado com sucesso!");</script>';
        }else{
            echo '<script>alert("Erro ao cadastrar o produto!");</script>';
        }
        include_once "inc/form_produto.inc";
        }
    }else{
        include_once "inc/form_produto.inc";
    }
}else{
  header("Location: index.php");
}
?>
