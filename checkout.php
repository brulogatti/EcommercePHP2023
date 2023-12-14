<?php
session_start();
if(isset($_SESSION["codigo"])){
    include_once "inc/checkout.inc";
}else{
    header("Location: user.php");
}
?>