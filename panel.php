<?php
	require('inc/db.php');
	mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error()); 
	mysql_select_db($db_database) or die(mysql_error()); 
	mysql_query("SET NAMES 'utf8'");
	unset($data);
	$data = mysql_query("SELECT * FROM udvalg") or die(mysql_error()); 
	echo '<div class="admin_titel">Udvalg</div><div class="group"><div class="add"><a href="inc/action.php?action=insert&table=udvalg">&#43;</a></div>(Tilføj)</div>';
	while($info = mysql_fetch_array( $data )) { 
		echo '
			<article class="admin_list">
			<form action="panel" method="post" enctype="multipart/form-data">
			<div class="group"><div class="remove"><a href="inc/action.php?action=remove&table=udvalg&id='.$info['id'].'">&#x2716;</a></div>(Fjern)</div>
			<input type="hidden" name="id" value="udvalg_'.$info['id'].'">
			<div class="admin_billede"><img class="admin_listebillede" src="'.$info['billede'].'"><label for="file">Billede: </label><input type="file" name="file" id="file" /></div>
			<div class="admin_form"><p class="admin_titel">Titel: <input type="text" name="titel" size="20" value="'.$info['titel'].'"></p><p class="admin_beskrivelse"><textarea name="beskrivelse" rows="10" cols="50">'.$info['beskrivelse'].'</textarea></p>
			<div class="admin_submit"><input type="submit" name="udvalg" class="button" value="Opdater"></div></div>
			</form>
			</article>
		';
	}
	if (isset($_POST["id"]) && substr($_POST['id'], 0, -2) == "udvalg") {
				echo "<script type=\"text/javascript\">
location.reload();
 </script>";
		$table = substr($_POST['id'], 0, -2);    
		$id = substr($_POST['id'], 7);
		$titel = $_POST['titel'];
		$beskrivelse = $_POST['beskrivelse'];
		mysql_query("UPDATE $table SET titel='$titel' WHERE id=$id") or die(mysql_error());
		mysql_query("UPDATE $table SET beskrivelse='$beskrivelse' WHERE id=$id") or die(mysql_error());
		if ($_FILES["file"]["name"] != "") {
			if ($_FILES["file"]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br />";
			}
			else {
				$file = $_FILES["file"]["name"];
				$file = strtolower($file);
				$file = str_replace(array('æ', 'ø', 'å', ' '), array('ae', 'oe', 'aa', '_'), $file);
				$url = "img/produkter/";
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
				mysql_query("UPDATE $table SET billede='$url$file' WHERE id=$id") or die(mysql_error());
				$_SESSION['expire'] = time() + (15 * 60);
				$_SESSION['action'] = "update";
				$_SESSION['message'] = "Objekt Opdateret.";
			}
		}
		$_SESSION['action'] = "update";
		$_SESSION['message'] = "Objekt Opdateret.";
	}
	echo '<hr>';


	unset($data);
	$data = mysql_query("SELECT * FROM udlejning") or die(mysql_error()); 
	echo '<div class="admin_titel">Udlejning</div><div class="group"><div class="add"><a href="inc/action.php?action=insert&table=udlejning">&#43;</a></div>(Tilføj)</div>';
	while($info = mysql_fetch_array( $data )) { 
		echo '
			<article class="admin_list">
			<form action="panel" method="post" enctype="multipart/form-data">
			<div class="group"><div class="remove"><a href="inc/action.php?action=remove&table=udlejning&id='.$info['id'].'">&#x2716;</a></div>(Fjern)</div>
			<input type="hidden" name="id" value="udlejning_'.$info['id'].'">
			<div class="admin_billede"><img class="admin_listebillede" src="'.$info['billede'].'"><label for="file">Billede: </label><input type="file" name="file" id="file" /></div>
			<div class="admin_form"><p class="admin_titel">Titel: <input type="text" name="titel" size="20" value="'.$info['titel'].'"></p><p class="admin_beskrivelse"><textarea name="beskrivelse" rows="10" cols="50">'.$info['beskrivelse'].'</textarea></p>
			<div class="admin_submit"><input type="submit" name="udlejning" class="button" value="Opdater"></div></div>
			</form>
			</article>
		';
	}
	if (isset($_POST["id"]) && substr($_POST['id'], 0, -2) == "udlejning") {
				echo "<script type=\"text/javascript\">
location.reload();
 </script>";
		$table = substr($_POST['id'], 0, -2);    
		$id = substr($_POST['id'], 10);
		$titel = $_POST['titel'];
		$beskrivelse = $_POST['beskrivelse'];
		mysql_query("UPDATE $table SET titel='$titel' WHERE id=$id") or die(mysql_error());
		mysql_query("UPDATE $table SET beskrivelse='$beskrivelse' WHERE id=$id") or die(mysql_error());
		if ($_FILES["file"]["name"] != "") {
			if ($_FILES["file"]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br />";
			}
			else {
				$file = $_FILES["file"]["name"];
				$file = strtolower($file);
				$file = str_replace(array('æ', 'ø', 'å', ' '), array('ae', 'oe', 'aa', '_'), $file);
				$url = "img/udlejning/";
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
				mysql_query("UPDATE $table SET billede='$url$file' WHERE id=$id") or die(mysql_error());
				$_SESSION['expire'] = time() + (15 * 60);
				$_SESSION['action'] = "update";
				$_SESSION['message'] = "Objekt Opdateret.";
			}
		}
		$_SESSION['action'] = "update";
		$_SESSION['message'] = "Objekt Opdateret.";
	}
	echo '<hr>';


	unset($data);
	$data = mysql_query("SELECT * FROM blog") or die(mysql_error()); 
	echo '<div class="admin_titel">Blog</div><div class="group"><div class="add"><a href="inc/action.php?action=insert&table=blog">&#43;</a></div>(Tilføj)</div>';
	while($info = mysql_fetch_array( $data )) { 
		echo '
			<article class="admin_list">
			<form action="panel" method="post" enctype="multipart/form-data">
			<div class="group"><div class="remove"><a href="inc/action.php?action=remove&table=blog&id='.$info['id'].'">&#x2716;</a></div>(Fjern)</div>
			<input type="hidden" name="id" value="blog_'.$info['id'].'">
			<div class="admin_billede"><img class="admin_listebillede" src="'.$info['billede'].'"><label for="file">Billede: </label><input type="file" name="file" id="file" /></div>
			<div class="admin_form"><p class="admin_titel">Titel: <input type="text" name="titel" size="20" value="'.$info['titel'].'"></p><p class="admin_beskrivelse"><textarea name="beskrivelse" rows="10" cols="50">'.$info['beskrivelse'].'</textarea></p>
			<div class="admin_submit"><input type="submit" name="blog" class="button" value="Opdater"></div></div>
			</form>
			</article>
		';
	}
	if (isset($_POST["id"]) && substr($_POST['id'], 0, -2) == "blog") {
				echo "<script type=\"text/javascript\">
location.reload();
 </script>";
		$table = substr($_POST['id'], 0, -2);    
		$id = substr($_POST['id'], 5);
		$titel = $_POST['titel'];
		$beskrivelse = $_POST['beskrivelse'];
		mysql_query("UPDATE $table SET titel='$titel' WHERE id=$id") or die(mysql_error());
		mysql_query("UPDATE $table SET beskrivelse='$beskrivelse' WHERE id=$id") or die(mysql_error());
		if ($_FILES["file"]["name"] != "") {
			if ($_FILES["file"]["error"] > 0) {
				echo "Error: " . $_FILES["file"]["error"] . "<br />";
			}
			else {
				$file = $_FILES["file"]["name"];
				$file = strtolower($file);
				$file = str_replace(array('æ', 'ø', 'å', ' '), array('ae', 'oe', 'aa', '_'), $file);
				$url = "img/blog/";
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
				mysql_query("UPDATE $table SET billede='$url$file' WHERE id=$id") or die(mysql_error());
				$_SESSION['expire'] = time() + (15 * 60);
				$_SESSION['action'] = "update";
				$_SESSION['message'] = "Objekt Opdateret.";
			}
		}
		$_SESSION['action'] = "update";
		$_SESSION['message'] = "Objekt Opdateret.";
	}
	echo '<hr>';
?>

