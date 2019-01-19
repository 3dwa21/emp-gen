<?php
	function run_generation($script,$parameter1 = 0,$parameter2 = 0) {
		include_once("generator_scripts/citystyle_generator.php");
		include_once("generator_scripts/authority_generator.php");
		include_once("generator_scripts/ethics_generator.php");
		include_once("generator_scripts/name_generator.php");
		include_once("generator_scripts/namelist_generator.php");
		include_once("generator_scripts/phenotype_generator.php");
		include_once("generator_scripts/planet_generator.php");
		include_once("generator_scripts/ship_prefix_generator.php");
		include_once("generator_scripts/ship_generator.php");
		include_once("generator_scripts/trait_generator.php");

		$output = "";
		
		//load Presets from last generation
		$planet = "arid";
		
		// Reloading script when regenerate-button is clicked
		// Names
		if ($script == "empirename") {
			$names = gen_name(0);
			foreach($names as $part) {
				$output = $output.$part."<br>";
			}
		}
		
		// Ship Prefix
		if ($script == "shipprefix") {
			$output = $output.gen_prefix()."<br>";
		}
		
		// Namelist
		if ($script == "namelist") {
			$output = $output.gen_namelist()."<br>";
		}	
			
		// Planet Type
		if ($script == "planet") {
			$planet = gen_planet();
			$output = $output.$planet."<br>";
		}
		
		// Citystyle
		if ($script == "citystyle") {
			$retrunvalue = gen_citystyle($planet);
			$output = $output.$retrunvalue[1]."<br><img src=\"".$retrunvalue[0]."\"/><br>";
		}
		
		// Phenotype
		if ($script == "phenotype") {
			$retrunvalue = gen_phenotype();
			$output = $output.$retrunvalue[1]."<br><img src=\"".$retrunvalue[0]."\"/><br>";
		}
		
		// Ship Style
		if ($script == "ships") {
			$retrunvalue = gen_ships();
			$output = $output.$retrunvalue[1]."<br><img src=\"".$retrunvalue[0]."\"/><br>";
		}
		
		// Traits
		if ($script == "traits") {
			$traits = gen_traits($parameter1,$parameter2);
			foreach($traits as $currenttrait) {
				$output = $output."<img src=\"".$currenttrait[6]."\"/> / ".$currenttrait[1]." / ".$currenttrait[4]."<br>";
			}
		}
		
		// Ethics
		if ($script == "ethics") {
			$ethics = gen_ethics();
			foreach($ethics as $currentethic) {
				$output = $output."<img src=\"".$currentethic[2]."\"/> / ".$currentethic[1]." / ".$currentethic[5]."<br>";
			}
		}
		
		// Authority
		if ($script == "authority") {
			$authority = gen_authority();
			$output = $output."<img src=\"".$authority[2]."\"/> / ".$authority[1]." / ".$authority[3]."<br>";
		}

		return $output;
	}

	if(isset($_GET['rerun'])) {
		if($_GET['rerun'] == 1) {
			$parameter1 = 0;
			$parameter2 = 0;

			$script = $_GET["script"];
			if(isset($_GET['parameter1'])) {
				$parameter1 = $_GET["parameter1"];
			}
			if(isset($_GET['parameter2'])) {
				$parameter2 = $_GET["parameter2"];
			}

			echo run_generation($script,$parameter1,$parameter2);
		}
	}
?>