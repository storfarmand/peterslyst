<?php
//Hent oplysninger fra form ved hjælp af POST
	session_start();
	$id = $_POST['id'];
	$username = $_POST['username'];
	$kommentar = $_POST['kommentar'];
	$date = date('d/m/Y');
	$time = date('H:i:s');
 
//inkluder db.php
	include 'db.php';
//Opret forbindelse til MySQL
	$conn = mysql_connect($db_server,$db_user,$db_password);
//Vælg database
	mysql_select_db($database, $conn);
//Indsæt i database
	mysql_query("SET NAMES 'utf8'");
	$query = "INSERT INTO kommentar ( bruger, status_id, kommentar ) VALUES ( '$username', '$id', '$kommentar' );";
	mysql_query($query) or die(mysql_error());
//Luk database
	mysql_close();
//Gå til login.html
	header('Location: ../wall.php');
?>