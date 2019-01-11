<?php

	function gen_ethics($rerun = 0, $minethics = 1, $maxethics = 3) { // parameter -> min. number of traits, max. number of traits;
		
		if ($rerun == 1) {
			include("globals.php");
			include_once("parser.php");
			include_once("get_active_mods.php");
		} else {
			include("../php/globals.php");
			include_once("../php/parser.php");
			include_once("../php/get_active_mods.php");
		}
		
		$activemods = get_active_mods();
	
		$ethics = array();
		// get data from database
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM `ethics` WHERE `4_mod` IN ($activemods)";
		foreach ($pdo->query($sql) as $row) {
			$ethics[] = $row;
		}
		
		$ok = FALSE;
		$points = 3;
		$choosen_ethics = array();
		$ethicIDs = array();
		
		$numofethics = rand($minethics,$maxethics);
		$allethics = count($ethics);
		
		$setauthority = 0;
		if (isset($_COOKIE[$cookie_authority])) {
			$setauthority = $_COOKIE[$cookie_authority];
		}
		
		while (!$ok) {
			$excluded = array();
			
			for ($i=0;$i<$numofethics;$i++) {
			
				$continue = FALSE;
				$generationfailed = FALSE;
				$failedcounter = 0;
				$newethic = 0;
				
				while (!$continue) {
					$newethic = rand(0,$allethics-1);
					$ethicID = $ethics[$newethic][0];
					$blocked_authorities = explode(",",$ethics[$newethic][7]);
					//print_r($blocked_authorities);
					//echo "	".$ethicID."<br>";
					if ((!in_array($ethicID, $excluded)) AND (!in_array($setauthority, $blocked_authorities))) {
						$continue = TRUE;
						$excluded[] = $ethicID;
						$ethicIDs[] = $ethicID;
					} else {
						$failedcounter++;
						if ($failedcounter == 30) {
							$generationfailed = TRUE;
							$failedcounter = 0;
							$continue = TRUE;
						}
					}
				}
				
				$newexcluded = explode(",",$ethics[$newethic][3]); // 3 -> exclude
				$numofnewexcluded = count($newexcluded);
				
				for ($j=0;$j<$numofnewexcluded;$j++) {
					$excluded[] = $newexcluded[$j];
				}
				
				$choosen_ethics[] = $ethics[$newethic];
				$ethicpoints = $ethics[$newethic][6]; // 6 -> cost
				$points = $points - $ethicpoints;
			}
			
			if (($points >= 0) AND (!$generationfailed)) {
				$ok = TRUE;
				$ethicIDs = implode(",",$ethicIDs);
			} else {
				$points = 3;
				$generationfailed = FALSE;
				$choosen_ethics = array();
				$ethicIDs = array();
			}
		}
		
		$numofchoosenethics = sizeof($choosen_ethics);
		for($i=0;$i<$numofchoosenethics;$i++) {
			$link = "../resources/img/ethics_imgs/".$choosen_ethics[$i][2].".png";
			$choosen_ethics[$i][2] = $link;
			
			$description = $choosen_ethics[$i][5];
			$description = parse_all($description,"description_imgs");
			$choosen_ethics[$i][5] = $description;
		}
		
		return $choosen_ethics;
	}
	
	//gen_traits();
	
?>