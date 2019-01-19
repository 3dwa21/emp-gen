<?php
	
	function left($str, $length) {
		return substr($str, 0, $length);
	}
	
	function right($str, $length) {
		return substr($str, -$length);
	}
	/////////////////////////////////////////////////////////////

	function gen_name($output_type = 0) { //output_type: 0 -> array; 1 -> name only
		$probs;
		$handle = fopen("../resources/csv/probs.csv", "r");
		while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
			$probs[] = $data;
		}
		fclose($handle);
		
		$numofletters = rand(4,9);
		$latestletter = rand(65,90);
		$name = chr($latestletter);
		$latestletter = $latestletter - 65;
		
		for ($i=1;$i<$numofletters;$i++) {
			$valuerand = lcg_value();
			$valuenext = 0;
			$nextletter = -1;
			while ($valuerand > $valuenext) {
				$nextletter++;
				$valuenext = $valuenext + $probs[$latestletter][$nextletter];
			}
			$nextletter = $nextletter + 97;
			$name = $name.chr($nextletter);
			$latestletter = $nextletter - 97;
		}
		
		$plural = "";
		$name_end_1 = right($name,1);
		$name_end_2 = right($name,2);
		
		if ((strcmp($name_end_1,"s") == 0) || (strcmp($name_end_1,"x") == 0) || (strcmp($name_end_1,"z") == 0) || (strcmp($name_end_2,"ch") == 0) || (strcmp($name_end_2,"sh") == 0)) {
			$plural = $name."es";
		}
		if (strcmp($name_end_1,"f") == 0) {
			$plural = substr($name, 0, -1)."ves";
		}
		if (strcmp($name_end_2,"fe") == 0) {
			$plural = substr($name, 0, -2)."ves";
		}
		if ((strcmp($name_end_1,"y") == 0) && (!((strcmp($name_end_2,"ay") == 0) || (strcmp($name_end_2,"ey") == 0) || (strcmp($name_end_2,"iy") == 0) || (strcmp($name_end_2,"oy") == 0) || (strcmp($name_end_2,"uy") == 0)))) {
			$plural = substr($name, 0, -1)."ies";
		}
		if ((strcmp($name_end_1,"o") == 0) && (!((strcmp($name_end_2,"ao") == 0) || (strcmp($name_end_2,"eo") == 0) || (strcmp($name_end_2,"io") == 0) || (strcmp($name_end_2,"oo") == 0) || (strcmp($name_end_2,"uo") == 0)))) {
			$plural = $name."es";
		}
		if (strcmp($plural,"") == 0) {
			$plural = $name."s";
		}
		
		$adjective = $name;
		if (strcmp($name_end_1,"a") == 0) {
			$adjective = $adjective."n";
		}
		if (strcmp($name_end_1,"e") == 0) {
			$adjective = substr($adjective, 0, -1)."an";
		}
		if (strcmp($name_end_1,"i") == 0) {
			$adjective = $adjective."an";
		}
		
		if ($output_type == 1) {
			return $name;
		} else {
			return array($name, $plural, $adjective);
		}
		//echo $name."<br>";
		//echo $plural."<br>";
		//echo $adjective;
	}
	
	//print_r(gen_name());
?>