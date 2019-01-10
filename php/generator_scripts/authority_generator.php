<?php
	
	function gen_authority($rerun = 0) {
	
		if ($rerun == 1) {
			include("globals.php");
			include_once("parser.php");
			include_once("get_active_mods.php");
		} else {
			include("php/globals.php");
			include_once("php/parser.php");
			include_once("php/get_active_mods.php");
		}
	
		$activemods = get_active_mods();
		
		$array = array();
		// get data from database
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM `authorities` WHERE `4_mod` IN ($activemods)";
		foreach ($pdo->query($sql) as $row) {
			$array[] = $row;
		}
		
		$setethics = 0;
		$blocked_authorities = array();
		if (isset($_COOKIE[$cookie_ethics])) {
			$setethics = $_COOKIE[$cookie_ethics];
			
			// get data from database
			$sql = "SELECT * FROM `ethics` WHERE `0_ID` IN ($setethics)";
			//echo $sql;
			foreach ($pdo->query($sql) as $row) {
				$actblocked = $row[7];
				$actblocked = explode(",",$actblocked);
				
				foreach ($actblocked as $actethic) {
					if (!in_array($actethic,$blocked_authorities)) {
						$blocked_authorities[] = $actethic;
					}
				}
			}
		}
		
		$continue = TRUE;
		$authorityID = 0;
		while ($continue) {
			$rows = count($array);
			$choosen_row = rand(0,$rows-1);
			$authorityID = $array[$choosen_row][0]; // 0 -> 0_ID
			
			if (!in_array($authorityID,$blocked_authorities)) {
				$continue = FALSE;
			}
		}
		
		$choosen_authority = $array[$choosen_row];
		
		$link = "resources/img/authority_imgs/".$choosen_authority[2].".png";
		$choosen_authority[2] = $link;
		
		$description = $choosen_authority[3];
		$description = parse_all($description,"description_imgs");
		$choosen_authority[3] = $description;
			
		return $choosen_authority;
	}
	
	//echo gen_authority();
	
?>