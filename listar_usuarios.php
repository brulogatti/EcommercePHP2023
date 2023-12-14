<?php
session_start();
if(isset($_SESSION) && $_SESSION["admin"]){
  include_once "inc/listar_usuarios.inc";
}else{
  header("Location: user.php");
}
?>
