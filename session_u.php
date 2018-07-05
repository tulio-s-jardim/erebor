<?php
session_start();
require_once 'php/usuario.php';
$usuario = new Usuario();
$usuario->setId($_SESSION['uid']);

if (!$usuario->exists()) {
    header('Location: login.php');
}
?>