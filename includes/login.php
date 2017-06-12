<?php
//Hent oplysninger fra form ved hjælp af POST
	$brugernavn_i = $_POST['username'];
	$password_i = $_POST['password'];
//inkluder db.php
	include 'db.php';
//Opret forbindelse til MySQL
	$conn = mysql_connect($db_server,$db_user,$db_password);
//Vælg database
	mysql_select_db($database, $conn);
//Vælg indhold i alle kolonner hvor brugernavn er lig indtastet brugernavn
	$sql = "SELECT * FROM brugere WHERE brugernavn='$brugernavn_i'";
	$result = mysql_query($sql, $conn) or die(mysql_error());
//Hvis resultat er over 0
	if(mysql_num_rows($result)>0) {
//mens der er resultater
		while ( $row = mysql_fetch_assoc($result) ) {
//Sæt PHP variabler
			$brugernavn_d = $row['brugernavn'];
			$password_d = $row['password'];
			$salt_d = $row['salt'];
		}
//Luk MySQL
		mysql_close($conn);
//Krypter password fra form
		$hash = hash('sha256', $password_i);
//Krypter krypteret password og Salt
		$password_c = hash('sha256', $salt_d . $hash);
//Er de 2 passwords ens?
		if ($password_c == $password_d) {
			session_start();
			$_SESSION['logged_in'] = TRUE;
			$_SESSION['expire'] = time() + (15 * 60);
			header('Location: ../panel');
		}
//Hvis de 2 passwords ikke er ens
		else {
			session_start();
			session_destroy();
			header('Location: ../123');
		}
	}
//Hvis der ikke er nogen resultater
	else {
		session_start();
		session_destroy();
		header('Location: ../312');
	}
?>