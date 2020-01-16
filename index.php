<?php
session_start(); 
include "dbConection.php";
include "functions.php";
$api_secret="09d051a47617e919c3accbc767d98f8618cc07fb";
$api_key="7e649b40df2cf76f8752a1444d499f1343ef6ef6";
date_default_timezone_set('America/Bogota');
$proyect1="2582096";
$proyect2="2583934";
$fecha = new DateTime();
$timestamp=$fecha->getTimestamp();
$hash = hash_hmac('sha1', $api_key . $timestamp, $api_secret);
$json = callApi("GET","https://freedcamp.com/api/v1/tasks/?project_id=$proyect1&api_key=$api_key&timestamp=$timestamp&hash=$hash");
$json= json_decode($json);
$list= $json->data->tasks[0]->task_group_name;
$task= "";
$resulset= $mysqli->query("SELECT * FROM tasks_list WHERE title='$list'");
if(count(mysqli_fetch_all($resulset))==0){
	$mysqli->query("INSERT INTO tasks_list(title, project_id) VALUES('$list','$proyect1')");
}
$id=$mysqli->insert_id;
for($i=0; $i<count($json->data->tasks); $i++){
	if($list !=$json->data->tasks[$i]->task_group_name){
		$list= $json->data->tasks[$i]->task_group_name;
		$resulset= $mysqli->query("SELECT * FROM tasks_list WHERE title='$list'");
		if(count(mysqli_fetch_all($resulset))==0){
		$mysqli->query("INSERT INTO tasks_list(title, project_id) VALUES('$list','$proyect1')");
      	}
		$id=$mysqli->insert_id;
	}
	$task=($json->data->tasks[$i]->title);
	$resulset= $mysqli->query("SELECT * FROM tasks t JOIN tasks_list tl USING(task_list_id) WHERE t.title='$task' AND tl.title='$list'");
	if(count(mysqli_fetch_all($resulset))==0){
		$mysqli->query("INSERT INTO tasks(title,task_list_id) VALUES('$task',$id)");
	}
}
$resulset= $mysqli->query("SELECT tl.title, t.title FROM tasks_list tl JOIN tasks t USING(task_list_id) ");
$resulset= mysqli_fetch_all($resulset);
$table="<table class='table'><tr class='bg-primary'><th>Lista de tareas</th> <th>Tareas</th></tr>";
for ($i=0; $i <count($resulset) ; $i++) { 
	$table.="<tr>";
	for ($j=0; $j <count($resulset[$i]) ; $j++) { 
		$table.="<td>".$resulset[$i][$j]."</td>";
	}
	$table.="</tr>";
}
$table.="</table>";

//2 proyecto
$json=null;
$fecha = new DateTime();
$timestamp=$fecha->getTimestamp();
$hash = hash_hmac('sha1', $api_key . $timestamp, $api_secret);
$json = callApi("GET","https://freedcamp.com/api/v1/tasks/?project_id=$proyect2&api_key=$api_key&timestamp=$timestamp&hash=$hash");
$json= json_decode($json);
$list= $json->data->tasks[0]->task_group_name;
$task= "";
$id=0;
$resulset= $mysqli->query("SELECT * FROM tasks_list WHERE title='$list'");
if(count(mysqli_fetch_all($resulset))==0){
	$mysqli->query("INSERT INTO tasks_list(title, project_id) VALUES('$list','$proyect2')");
	$id=$mysqli->insert_id;
}
for($i=0; $i<count($json->data->tasks); $i++){
	if($list !=$json->data->tasks[$i]->task_group_name){
		$list= $json->data->tasks[$i]->task_group_name;
		$resulset= $mysqli->query("SELECT * FROM tasks_list WHERE title='$list'");
		if(count(mysqli_fetch_all($resulset))==0){
		$mysqli->query("INSERT INTO tasks_list(title, project_id) VALUES('$list','$proyect2')");
      	}
		$id=$mysqli->insert_id;
	}
	$task=($json->data->tasks[$i]->title);
	$resulset= $mysqli->query("SELECT * FROM tasks t JOIN tasks_list tl USING(task_list_id) WHERE t.title='$task' AND tl.title='$list'");
	if(count(mysqli_fetch_all($resulset))==0){
		$mysqli->query("INSERT INTO tasks(title,task_list_id) VALUES('$task',$id)");
	}
}
$resulset= $mysqli->query("SELECT tl.title, t.title  FROM tasks_list tl JOIN tasks t USING(task_list_id) WHERE project_id=$proyect2 ");
$resulset= mysqli_fetch_all($resulset);
$table2="<table class='table'><tr class='bg-primary'><th>Lista de tareas</th> <th>Tareas</th></tr>";
for ($i=0; $i <count($resulset) ; $i++) { 
	$table2.="<tr>";
	for ($j=0; $j <count($resulset[$i]) ; $j++) { 
		$table2.="<td>".$resulset[$i][$j]."</td>";
	}
	$table2.="</tr>";
}
$table2.="</table>";
$mysqli->close(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="web aplicaction about Freedcamp api">
	<meta name="author" content="David Santiago Malagon Caballero">

	<title>Freedcamp web app</title>

	<!-- Bootstrap core CSS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>

<body>

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary static-top">
		<div class="container">
			<a class="navbar-brand" href="/">FreedCamp web app</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto">
					<!-- <li class="nav-item active">
						<a class="nav-link" href="#">Inicio
							<span class="sr-only">(current)</span>
						</a>
					</li> -->
					<li class="nav-item">
						<a class="nav-link" href="signup.html">Registrarse</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="signin.html">Ingresar</a>
					</li>
					<?php
						if (count($_SESSION)>0){
							echo "<li class='nav-item'>
							<a class='nav-link' href='signin.html'>".$_SESSION["name"]."</a>
							</li>
							<li class='nav-item'>
						<a class='nav-link' href='signout.php'>Cerrar Sesión</a>
							</li>";
						}
					?>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-12 text-center">
				<center>
				<?php
				echo "<br/> Aplicación web ";
				echo $table;
				echo "<br/> Migración tecnologia";
				echo $table2;
				?>
				</center>
			</div>
		</div>
	</div>
</body>

</html>
