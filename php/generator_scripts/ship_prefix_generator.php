<?php
	
	function gen_prefix() {
		$numofletters = rand(2,4);
		$name = "";
		
		for ($i=0;$i<$numofletters;$i++) {
			$latestletter = rand(65,90);
			$name = $name.chr($latestletter);
		}
		
		return $name;
	}
	
	//echo gen_prefix();
	
?>