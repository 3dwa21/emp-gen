<?php
	
	function gen_ships($rerun = 0) {
	
		if ($rerun == 1) {
			include("globals.php");
			include_once("get_active_mods.php");
		} else {
			include("php/globals.php");
			include_once("php/get_active_mods.php");
		}
	
		$activemods = get_active_mods();
		
		$array = array();
		// get data from database
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM `ships` WHERE `2_mod` IN ($activemods)";
		foreach ($pdo->query($sql) as $row) {
			$array[] = $row;
		}
		
		$rows = count($array);
		$choosen_row = rand(0,$rows-1);
		$choosen_ship = $array[$choosen_row][1]; // 1 -> 1_name
		$choosen_ship_file = $array[$choosen_row][3]; // 3 -> 3_file
		$link = "resources/img/ships_imgs/".$choosen_ship_file.".bmp";
		
		$output[] = $link;
		$output[] = $choosen_ship;
		
		return $output;
	}
	
	//$retrunvalue = gen_ships();
	//echo $retrunvalue[1]."<br><img src=\"".$retrunvalue[0]."\"/>";
	
?>