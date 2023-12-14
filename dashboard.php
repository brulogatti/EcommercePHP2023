<?php
session_start();
if (isset($_SESSION) && $_SESSION["admin"]) {
  require_once "funcoes.php";
  include_once "inc/dashboard.inc";
}else{
  header("Location: index.php");
}
?>