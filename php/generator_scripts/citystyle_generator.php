<?php
	
	function gen_citystyle($rerun = 0, $planetparam = "") {
		
		if ($rerun == 1) {
			include("globals.php");
			include_once("get_active_mods.php");
		} else {
			include("../php/globals.php");
			include_once("../php/get_active_mods.php");
		}
		
		$activemods = get_active_mods();
		
		$array = array();
		// get data from database
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$sql = "SELECT * FROM `citystyle` WHERE `2_mod` IN ($activemods)";
		foreach ($pdo->query($sql) as $row) {
			$array[] = $row;
		}
		
		$rows = count($array);
		$choosen_row = rand(0,$rows-1);
		$choosen_style = $array[$choosen_row][1]; // 1 -> 1_name
		$choosen_style_linkpart = $array[$choosen_row][3]; // 3 -> 3_linkpart
		
		$planetparam = strtolower($planetparam);
		
		$img = $planetparam."_".$choosen_style_linkpart.".bmp";
		$link = "../resources/img/city_styles_imgs/".$img;
		
		$output[] = $link;
		$output[] = $choosen_style;
		
		return $output;
	}
	
	//$retrunvalue = gen_citystyle();
	//echo $retrunvalue[1]."<br><img src=\"".$retrunvalue[0]."\"/>";
	
?>