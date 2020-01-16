<?php
//"localhost: 3306"

$hotsdb = "localhost";    
$db = "freedcamp";   
$dbUser = "dbUser";   
$dbPassword = "dbPassword";    
$mysqli = new mysqli('localhost', $dbUser, $dbPassword, $db)
or die ("Conexión denegada, el Servidor de Base de datos que solicitas NO EXISTE");
$mysqli->query("SET NAMES 'utf8'");
?>