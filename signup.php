<?php 
$name = $_POST["first_name"];
$email = $_POST["email"];
$last_name =$_POST["last_name"];
$password=$_POST["password"];
$birth_date=$_POST["birth_date"];
include("dbConection.php");    
$mysqli->query( "INSERT INTO users(first_name,last_name,email,secret,birth_date) VALUES('$name','$last_name', '$email','$password','$birth_date')"); 

if($mysqli->affected_rows>0 ){
echo "<p>$name, ya estas registrado. <a href='/'> Inciar sesion </a></p>";  
}
else {
echo "No fue posible realizar el registro";
}
$mysqli->close(); 
?>  