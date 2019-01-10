<?php

	include("globals.php");

	$numofmods = $_POST['modcounter'];
	
	for ($i=0;$i<$numofmods;$i++) {
		$active = $_POST[$i];
		echo $active." - ".$i."<br>";
		try {
			$connection = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully"; 
			
			$sql = "UPDATE `mods` SET `2_active`=$active WHERE `mods`.`0_ID`=$i";
			
			$connection->exec($sql);
			
		} catch(PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
		}
	}
	
	header('Location: ../html/mod_settings.html');
	
?>