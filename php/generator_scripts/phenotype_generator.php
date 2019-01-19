<?php
	
	function gen_phenotype() {
	
		include("globals.php");
		include_once("get_active_mods.php");
		
		$activemods = get_active_mods();
		
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM `phenotype_categories`";
		$numofcategories = 0;
		foreach ($pdo->query($sql) as $row) {
			$categories[] = $row;
			$numofcategories++;
		}
	
		$category = rand(0,$numofcategories-1);
		$categoryok = false;
		$activemods_array = explode(",",$activemods);
		$numofactivemods = sizeof($activemods_array);
		
		while (!$categoryok) {
			$categorymod = $categories[$category][2]; // 2 -> mod
			for ($i=0;$i<$numofactivemods;$i++) {
				$modid = $activemods_array[$i];
				if ($categorymod == $modid) {
					$categoryok = true;
				}
			}
			if (!$categoryok) {
				$category = rand(0,$numofcategories);
			}
		}
		
		$links = array();
		// get data from database
		$sql = "SELECT * FROM `phenotypes` WHERE `1_category`=".$category." AND `3_mod` IN ($activemods)";
		foreach ($pdo->query($sql) as $row) {
			$links[] = $row;
		}
		
		$rows = count($links);
		$choosen_row = rand(0,$rows-1);
		$choosen_img = $links[$choosen_row][2]; // 2 -> link
		$choosen_img = "../resources/img/species_imgs/".$choosen_img.".bmp";
		
		$output[] = $choosen_img;
		$output[] = $categories[$category][1]; // 1 -> name
		
		return $output;
	}
	
	//$retrunvalue = gen_phenotype();
	//echo $retrunvalue[1]."<br><img src=\"".$retrunvalue[0]."\"/>";
	
?>