<?php

	function gen_traits($mintraits = 0, $maxtraits = 5) { // parameter -> min. number of traits, max. number of traits;
		
		include("globals.php");
		include_once("parser.php");
		include_once("get_active_mods.php");
		
		$activemods = get_active_mods();
	
		$traits = array();
		// get data from database
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM `traits` WHERE `5_mod` IN ($activemods)";
		foreach ($pdo->query($sql) as $row) {
			$traits[] = $row;
		}
		
		$points = 2;
		$numoftraits = rand($mintraits,$maxtraits);
		$alltraits = count($traits);
		$choosen_traits = array();
		$ok = FALSE;
		
		while (!$ok) {
			$excluded = array();
			
			for ($i=0;$i<$numoftraits;$i++) {
			
				$continue = FALSE;
				$newtrait = 0;
				
				while (!$continue) {
					$newtrait = rand(0,$alltraits-1);
					$traitID = $traits[$newtrait][0];
					if (!in_array($traitID, $excluded)) {
						$continue = TRUE;
						$excluded[] = $traitID;
					}
				}
				
				$newexcluded = explode(",",$traits[$newtrait][3]);
				$numofnewexcluded = count($newexcluded);
				
				for ($j=0;$j<$numofnewexcluded;$j++) {
					$excluded[] = $newexcluded[$j];
				}
				
				$choosen_traits[] = $traits[$newtrait];
				$traitpoints = $traits[$newtrait][2];
				$points = $points - $traitpoints;
			}
			
			if ($points >= 0) {
				$ok = TRUE;
			} else {
				$choosen_traits = array();
				$points = 2;
			}
		}
		
		$numofchoosentraits = sizeof($choosen_traits);
		for($i=0;$i<$numofchoosentraits;$i++) {
			$link = "../resources/img/traits_imgs/".$choosen_traits[$i][6].".png";
			$choosen_traits[$i][6] = $link;
			
			$description = $choosen_traits[$i][4];
			$description = parse_all($description,"description_imgs");
			$choosen_traits[$i][4] = $description;
		}
		
		return $choosen_traits;
	}
	
	//gen_traits();

?>