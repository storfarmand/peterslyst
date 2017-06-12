<?php
	session_start();
	if(isset($_SESSION['logged_in'])){
		if( $_SESSION['logged_in'] == TRUE ) {
			$panel = TRUE;
			if (time() > $_SESSION['expire']) {
				session_destroy();
				session_start();
				$_SESSION['action'] = "timed_out";
				$_SESSION['message'] = "Der var en timeout. Log venligst ind igen.";
				header('Location: /');
			}
		}
	}
?>

<!-------------------------------------------------------------------------------------------->
<!--                                                                                        -->
<!--       _____               _               _______ _                                    -->
<!--      / ____|             | |             |__   __| |                                   -->
<!--     | |     __ _ _ __ ___| |_ ___ _ __      | |  | |__  _   _  ___  ___  ___ _ __      -->
<!--     | |    / _` | '__/ __| __/ _ \ '_ \     | |  | '_ \| | | |/ _ \/ __|/ _ \ '_ \     -->
<!--     | |___| (_| | |  \__ \ ||  __/ | | |    | |  | | | | |_| |  __/\__ \  __/ | | |    -->
<!--      \_____\__,_|_|  |___/\__\___|_| |_|    |_|  |_| |_|\__,_|\___||___/\___|_| |_|    -->
<!--                                                                                        -->
<!--                                                                                        -->
<!-------------------------------------------------------------------------------------------->

<!doctype html>
<html lang="da">
	<head>
		<meta charset="utf-8">
		<base href="/">
		<title>Gaardbutikken Peterslyst</title>
		<meta name="description" content="Peterslyst er en gårdbutik, beliggende i Ingerslev, udenfor Hasselager, der sælger kartofler, jordbær og årstidens grøntsager. Ud over gårdbutik udlejes der også værktøj og stilladser. Peterslyst har også vikarservice.">
		<meta name="keywords" content="gårdbutik, vikarservice, værktøj, udlejning, grøntsager, jordbær, kartofler, jord til bord, frisk">
		<meta name="author" content="Carsten Thuesen">
		<?php
			if (strstr($_SERVER['HTTP_USER_AGENT'], 'iPhone') ||
			strstr($_SERVER['HTTP_USER_AGENT'],'iPod') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'Android') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'Blackberry') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'OperaMobi') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'IEMobile') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'Jasmine') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'Fennec') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'Blazer') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'Minimo') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'MOT-') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'Nokia') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'SAMSUNG') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'Polaris') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'LG-') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'SonyEricsson') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'SIE-') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'AUDIOVOX') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'mobile') ||
			strstr($_SERVER['HTTP_USER_AGENT'], 'webOS')) {
				echo '<link href="/css/mobile.css" rel="stylesheet" type="text/css">';
			}
			else {
				echo '<link href="/css/screen.css" rel="stylesheet" type="text/css">';
			}
		?>

		<!--[if lt IE 9]>
			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<script type="text/javascript" src="inc/s3Slider.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#slider').s3Slider({
					timeOut: 3500
				});
			});
		</script>
		<script>     
			$(document).ready(function () {
				var hide = function () {
					$(".message").slideUp(1000, 'swing');
				}
				window.setTimeout(hide, 3000);
			});
		</script>
	</head>
	<body>
		<div class="bg_logo"></div>
		<div class="bg_opacity"></div>
		<div class="wrapper">
			<header>
				<div class="horizontal_grey"></div>
				<figure class="plaque">
					<a href="http://warptwist.fp-lightsolutions.dk/"><img class="logo" src="img/logo.svg" alt="Peterslyst logo"></a>
				</figure>
				<div id="slider">
					<ul id="sliderContent">
						<li class="sliderImage">
							<a href="/beliggenhed"><img src="/img/beliggenhed.jpg" alt="2" />
							<span class="bottom">Peterslyst ligger i Ingerslev, lige udenfor Hasselager. Gaardbutikken ligger i flotte naturlige omgivelser.</span></a>
						</li>
						<li class="sliderImage">
							<a href="/historie"><img src="/img/historie.jpg" alt="2" />
							<span class="bottom">Gaarbutikken åbnede første gang i 2014.</span></a>
						</li>
						<li class="sliderImage">
						</li>
					</ul>
				</div>
				<a href="/udvalg">
					<div class="openinghours">
						<p class="header">Åbningstider:</p>
						<div class="grouphours">
							<p class="hours">Mandag til Fredag:</p>
							<p class="hours">7.00 – 20.00</p>
						</div>
						<div class="grouphours">
							<p class="hours"> Lørdag og Søndag:</p>
							<p class="hours">8.00 – 20.00</p>
						</div>
					</div>
				</a>
			</header>
			<nav class="menu">
				<ul class="dropdown">
					<li class="menu_top">Gaardbutik
						<ul>
							<li><a href="/udvalg">Udvalg</a></li>
							<li><a href="/historie">Historie</a></li>
							<li><a href="/beliggenhed">Beliggenhed</a></li>
							<li><a href="/blog">Blog</a></li>
						</ul>
					</li>
					<li class="menu_top"><a href="/udlejning">Udlejning</a></li>
					<li class="menu_top"><a href="/vikarservice">Vikarservice</a></li>
				</ul>
			</nav>
			<section class="main">

			
<?php
	require('db.php');
	mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error()); 
	mysql_select_db($db_database) or die(mysql_error()); 
	mysql_query("SET NAMES 'utf8'");
	$action = $_GET['action'];
	$table = $_GET['table'];
	$id = $_GET['id'];
	if ($action == "remove"){
	$data = mysql_query("SELECT * FROM $table WHERE id='$id'") or die(mysql_error()); 
		mysql_query("DELETE FROM $table WHERE id='$id'") or die(mysql_error());
	while($info = mysql_fetch_array( $data )) { 
		$file = $info['billede'];
		unlink($file);
		}
		header("Refresh:0; url=../panel");
		session_start();
		$_SESSION['expire'] = time() + (15 * 60);
		$_SESSION['action'] = "remove";
		$_SESSION['message'] = "Objekt fjernet.";
	}
	if ($action == "insert"){
		if (isset($_POST['section']) && $_POST['section'] == "udvalg") {
			$id = substr($_POST['id'], 7);
			$titel = $_POST['titel'];
			$beskrivelse = $_POST['beskrivelse'];
			if ($_FILES["file"]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br />";
			}
			else {
				$file = $_FILES["file"]["name"];
				$file = strtolower($file);
				$file = str_replace(array('æ', 'ø', 'å', ' '), array('ae', 'oe', 'aa', '_'), $file);
				$url = "../img/produkter/";
				$actual_name = pathinfo($file,PATHINFO_FILENAME);
				$original_name = $actual_name;
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				$i = 1;
				while(file_exists($url.$actual_name.".".$extension)) {
					$actual_name = (string)$original_name.'_'.$i;
					$file = $actual_name.".".$extension;
					$i++;
				}
				move_uploaded_file($_FILES["file"]["tmp_name"],$url.$file);
				mysql_query("INSERT INTO $table (titel, beskrivelse, billede) VALUES( '$titel', '$beskrivelse', '$url$file' ) ") or die(mysql_error());  
				header("Refresh:0; url=../panel");
				session_start();
				$_SESSION['expire'] = time() + (15 * 60);
				$_SESSION['action'] = "insert";
				$_SESSION['message'] = "Objekt oprettet.";
			}
		}
		elseif (isset($_POST['section']) && $_POST['section'] == "udlejning") {
			$titel = $_POST['titel'];
			$beskrivelse = $_POST['beskrivelse'];
			if ($_FILES["file"]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br />";
			}
			else {
				$file = $_FILES["file"]["name"];
				$file = strtolower($file);
				$file = str_replace(array('æ', 'ø', 'å', ' '), array('ae', 'oe', 'aa', '_'), $file);
				$url = "../img/udlejning/";
				$actual_name = pathinfo($file,PATHINFO_FILENAME);
				$original_name = $actual_name;
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				$i = 1;
				while(file_exists($url.$actual_name.".".$extension)) {
					$actual_name = (string)$original_name.'_'.$i;
					$file = $actual_name.".".$extension;
					$i++;
				}
				move_uploaded_file($_FILES["file"]["tmp_name"],$url.$file);
				mysql_query("INSERT INTO $table (titel, beskrivelse, billede) VALUES( '$titel', '$beskrivelse', '$url$file' ) ") or die(mysql_error());  
				header("Refresh:0; url=../panel");
				session_start();
				$_SESSION['expire'] = time() + (15 * 60);
				$_SESSION['action'] = "insert";
				$_SESSION['message'] = "Objekt oprettet.";
			}
		}
		elseif (isset($_POST['section']) && $_POST['section'] == "blog") {
			$titel = $_POST['titel'];
			$beskrivelse = $_POST['beskrivelse'];
			if ($_FILES["file"]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br />";
			}
			else {
				$file = $_FILES["file"]["name"];
				$file = strtolower($file);
				$file = str_replace(array('æ', 'ø', 'å', ' '), array('ae', 'oe', 'aa', '_'), $file);
				$url = "../img/blog/";
				$actual_name = pathinfo($file,PATHINFO_FILENAME);
				$original_name = $actual_name;
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				$i = 1;
				while(file_exists($url.$actual_name.".".$extension)) {
					$actual_name = (string)$original_name.'_'.$i;
					$file = $actual_name.".".$extension;
					$i++;
				}
				move_uploaded_file($_FILES["file"]["tmp_name"],$url.$file);
				mysql_query("INSERT INTO $table (titel, beskrivelse, billede) VALUES( '$titel', '$beskrivelse', '$url$file' ) ") or die(mysql_error());  
				header("Refresh:0; url=../panel");
				session_start();
				$_SESSION['expire'] = time() + (15 * 60);
				$_SESSION['action'] = "insert";
				$_SESSION['message'] = "Objekt oprettet.";
			}
		}
		
		echo '
			<article class="detail">
			<form action="" method="post" enctype="multipart/form-data">
			<div class="admin_billede"><img class="admin_listebillede" src="../img/bannerholder.jpg"/>
			<label for="file">Vælg billede: </label><input type="file" name="file" id="file" /></div>
			<div class="admin_form"><p class="admin_titel">Skriv titel: <input type="text" name="titel" size="20" ></p>
			<p class="admin_beskrivelse"><textarea name="beskrivelse" rows="10" cols="50">Skriv beskrivelse her:</textarea></p>
			<input type="hidden" name="section" value="'.$table.'">
			<div class="admin_submit"><input type="submit" class="button" value="Opret"></div></div>
			</form>
			</article>
		';
	}
?>

			</section>
			<footer>
				<p class="footer_text">&copy;2014 - PetersLyst Gaardbutik v/Palle Sørensen, Hovvejen 9, 8361 Hasselager, Tlf: 40364142 - CVR. 33175574</p>
			</footer>
		</div>
	</body>
</html> 