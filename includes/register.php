<?php
//Hent oplysninger fra form ved hjælp af POST
	$username = $_POST['username'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$email = $_POST['email'];
//inkluder db.php
	include 'db.php';
//Er password1 og password2 ikke ens, så send tilbage til registreringsform
	if($password1 != $password2) header('Location: ../registration.html');
//Er username større end 30 bogstaver lang, så send tilbage til registreringsform
	if(strlen($username) > 30) header('Location: ../registration.html');
//Opret forbindelse til MySQL
	$conn = mysql_connect($db_server,$db_user,$db_password);
//Vælg database
	mysql_select_db($database, $conn);
//Vælg indhold i alle kolonner hvor brugernavn er lig indtastet brugernavn
	$query = "SELECT * FROM brugere WHERE brugernavn='$username' OR email ='$email'";
	$result = mysql_query($query, $conn) or die(mysql_error());
//Hvis resultat er over 0
	if(mysql_num_rows($result)>0) {
//Send tilbage til form
		header('Location: ../registration.html');
	}
//Krypter password1
$hash = hash('sha256', $password1);
//Funktion til at oprette Salt (ekstra krypteringsfunktion)
	function createSalt() {
		$text = md5(uniqid(rand(), true));
		return substr($text, 0, 3);
	}
 	$salt = createSalt();
//Krypter krypteret password og Salt
	$password = hash('sha256', $salt . $hash);
//Omsæt username til reele bogstaver
	$username = mysql_real_escape_string($username);
//Indsæt i database
	$query = "INSERT INTO brugere ( `id`, brugernavn, password, email, salt ) VALUES ( NULL, '$username', '$password', '$email', '$salt' );";
	mysql_query($query) or die(mysql_error());
//Luk database
	mysql_close();
//Gå til login.html
	header('Location: ../index.php');
?>