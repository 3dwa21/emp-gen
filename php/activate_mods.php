<?php

	include("globals.php");

	$user_id = $_COOKIE[$cookieid];
	$numofmods = $_POST['modcounter'];
	$activemods = array();
	
	for ($i=0;$i<$numofmods;$i++) {
		$active = $_POST[$i];
		if ($active) {
			$activemods[] = $i;
		}
	}
	$activemods = implode(",",$activemods);

	try {
		$connection = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
		
		$sql = "UPDATE `usersettings` SET `1_active_mods`='$activemods' WHERE `usersettings`.`0_userid`=$user_id";
		$connection->exec($sql);
		
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}
	
	header('Location: ../html/mod_settings.html');
	
?>