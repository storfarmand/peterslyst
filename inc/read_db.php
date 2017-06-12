 <?php 
	function read_db() {
		unset($args);
		foreach ( func_get_args() as $arg ) {
			$args[] = $arg;
		}
		require('db.php');
		mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error()); 
		mysql_select_db($db_database) or die(mysql_error()); 
		mysql_query("SET NAMES 'utf8'");
		$data = mysql_query("SELECT * FROM $args[0]") or die(mysql_error()); 
		while($info = mysql_fetch_array( $data )) { 
			foreach (array_slice($args,1) as $field) { 
				$cell[] = $info[$field];
			}
		}
		return $cell;
	}
?> 