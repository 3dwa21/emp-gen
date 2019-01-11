<?php
	
	function gen_namelist($rerun = 0) {
	
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
		$sql = "SELECT * FROM `namelists` WHERE `2_mod` IN ($activemods)";
		foreach ($pdo->query($sql) as $row) {
			$array[] = $row;
		}
		
		$rows = count($array);
		$choosen_row = rand(0,$rows-1);
		$choosen_list = $array[$choosen_row][1]; // 1 -> 1_name
		
		return $choosen_list;
	}
	
	//echo gen_namelist();
	
?>