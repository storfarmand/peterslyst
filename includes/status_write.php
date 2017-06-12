<?php
//Hent oplysninger fra form ved hjælp af POST
	session_start();
	$username = $_SESSION['user'];
	$status = $_POST['status'];
//inkluder db.php
	include 'db.php';
//Opret forbindelse til MySQL
	$conn = mysql_connect($db_server,$db_user,$db_password);
//Vælg database
	mysql_select_db($database, $conn);
//Indsæt i database
	mysql_query("SET NAMES 'utf8'");
	$query = "INSERT INTO status ( bruger, status ) VALUES ( '$username', '$status' );";
	mysql_query($query) or die(mysql_error());
//Luk database
	mysql_close();
//Gå til wall
	header('Location: ../wall.php');
?>