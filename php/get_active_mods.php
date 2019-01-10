<?php
	
	function get_active_mods() {
	
		include("globals.php");
	
		// get data from database
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM `mods` WHERE `2_active`=1";
		
		$activemods = "";
		foreach ($pdo->query($sql) as $row) {
			$modid = $row["0_ID"];
			$activemods = $activemods.$modid.",";
		}
		$activemods = substr($activemods, 0, -1);
		
		return $activemods;
	}
	
?>