<?php
session_start("i-factory");

function __autoload($class_name){
	require_once "class/".$class_name.".php";
}

$pagina = Helpers::getNomeFile();
$pagina = $pagina ? $pagina : "home.html";
$dominio = $_SERVER['SERVER_NAME'];
?>