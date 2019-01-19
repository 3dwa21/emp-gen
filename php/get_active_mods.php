<?php
	
	function get_active_mods() {
	
		include("globals.php");

		$user_id = $_COOKIE[$cookieid];
	
		// get data from database
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM `usersettings` WHERE `0_userid` = ".$user_id;
		
		$stmt = $pdo->prepare($sql); 
		$stmt->execute(); 
		$row = $stmt->fetch();
		$activemods = $row['1_active_mods'];
		
		return $activemods;
	}
	
?>