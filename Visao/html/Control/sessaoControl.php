<?php
session_start();
include_once 'CRUD.class.php';
if(!isset($_SESSION['usuarioLogin'])){
header('Location:../index.php');
}
?>