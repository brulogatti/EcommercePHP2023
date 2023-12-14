<?php
session_start();
require_once "funcoes.php";
if (isset($_SESSION) && $_SESSION["admin"]) {
  include_once "inc/listar_pedidos.inc";
} else {
  header("Location: user.php");
}
