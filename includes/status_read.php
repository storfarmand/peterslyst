<?php
//inkluder db.php
	include 'includes/db.php';
//Opret forbindelse til MySQL
	$conn = mysql_connect($db_server,$db_user,$db_password);
//Vælg database
	mysql_select_db($database, $conn);
//Vælg indhold i alle kolonner hvor brugernavn er lig indtastet brugernavn
	mysql_query("SET NAMES 'utf8'");
	$status_sql = "SELECT * FROM status ORDER BY `dato` DESC";
	$status_d = mysql_query($status_sql, $conn) or die(mysql_error());
//mens der er resultater
	while ( $row = mysql_fetch_assoc($status_d) ) {
//Sæt PHP variabler
		$id = $row['id'];
		$dato = date('d/m/Y', strtotime($row['dato']));
		$tid = date('H:i:s', strtotime($row['dato']));
		$bruger = $row['bruger'];
		$status = $row['status'];
//Print værdier
		echo '
			<article>
				<div class="kommentar">
					<div class="status">
						<div class="info">
							<span class="bruger">
								' . $bruger . '
							</span>
							<span class="tid">
								' . $tid . '
							</span>
							<span class="dato">
								' . $dato . '
							</span>
						</div>
						<p>
							' . $status . '
						</p>
					</div>
		';
		$kommentar_sql = "SELECT * FROM kommentar WHERE status_id = $id ORDER BY `dato` DESC";
		$kommentar_d = mysql_query($kommentar_sql, $conn) or die(mysql_error());
//mens der er resultater
		while ( $kom = mysql_fetch_assoc($kommentar_d) ) {
			$kom_dato = date('d/m/Y', strtotime($kom['dato']));
			$kom_tid = date('H:i:s', strtotime($kom['dato']));
			$kom_bruger = $kom['bruger'];
			$kommentar = $kom['kommentar'];
			echo '
				<div class="status">
					<div class="info">
						<span class="bruger">
							' . $kom_bruger . '
						</span>
						<span class="tid">
							' . $kom_tid . '
						</span>
						<span class="dato">
							' . $kom_dato . '
						</span>
					</div>
					<p>
						' . $kommentar . '
					</p>
				</div>
			';
		}
		echo '
			<form name="status_kommentar" action="includes/kommentar_write.php" method="POST">	
				<textarea cols="45" rows="2" name="kommentar" placeholder="Kommenter denne status"></textarea>  
				<p>
					<input type="hidden"  name="username" value="' . $_SESSION['user'] . '"">
					<input type="hidden" name="id" value="' . $id . '">         
					<input id="submit" type="submit" value="Slå op!">         
				</p>
			</form>
		</article>';
	}
//Luk MySQL
	mysql_close($conn);
?>