<?php
session_start(); 
$email = $_POST["email"];
$password=$_POST["password"];
include("dbConection.php");    
$result= $mysqli->query("SELECT first_name FROM users WHERE email='$email' AND secret='$password' "); 
$result=mysqli_fetch_all($result);
if(count($result)==0){
   echo "Datos incorrectos";
}
else{

	$_SESSION["name"] = $result[0][0];
	echo "<p>Acceso concedido <a href='/'> Inicio </a></p>";
}
$mysqli->close(); 
?>  
