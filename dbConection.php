<?php
//"localhost: 3306"

$hotsdb = "localhost";    
$db = "esmerald_freedcamp";   
$dbUser = "esmerald";   
$dbPassword = "v48oCNG88+opC+";    
$mysqli = new mysqli('localhost', $dbUser, $dbPassword, $db)
or die ("Conexión denegada, el Servidor de Base de datos que solicitas NO EXISTE");
$mysqli->query("SET NAMES 'utf8'");
?>