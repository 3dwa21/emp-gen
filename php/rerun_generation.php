<?php
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
	
	$script = $_GET["script"];
	if(isset($_GET['parameter1'])) {
		$parameter1 = $_GET["parameter1"];
	}
	if(isset($_GET['parameter2'])) {
		$parameter2 = $_GET["parameter2"];
	}
	
	//load Presets from last generation
	$planet = "arid";
	
	// Reloading script when regenerate-button is clicked
	// Names
	if ($script == "empirename") {
		$names = gen_name(0);
		foreach($names as $part) {
			echo $part."<br>";
		}
	}
	
	// Ship Prefix
	if ($script == "shipprefix") {
		echo gen_prefix()."<br>";
	}
	
	// Namelist
	if ($script == "namelist") {
		echo gen_namelist(1)."<br>";
	}	
		
	// Planet Type
	if ($script == "planet") {
		$planet = gen_planet(1);
		echo $planet."<br>";
	}
	
	// Citystyle
	if ($script == "citystyle") {
		$retrunvalue = gen_citystyle(1,$planet);
		echo $retrunvalue[1]."<br><img src=\"".$retrunvalue[0]."\"/><br>";
	}
	
	// Phenotype
	if ($script == "phenotype") {
		$retrunvalue = gen_phenotype(1);
		echo $retrunvalue[1]."<br><img src=\"".$retrunvalue[0]."\"/><br>";
	}
	
	// Ship Style
	if ($script == "ships") {
		$retrunvalue = gen_ships(1);
		echo $retrunvalue[1]."<br><img src=\"".$retrunvalue[0]."\"/><br>";
	}
	
	// Traits
	if ($script == "traits") {
		$traits = gen_traits(1,$parameter1,$parameter2);
		foreach($traits as $currenttrait) {
			echo "<img src=\"".$currenttrait[6]."\"/> / ".$currenttrait[1]." / ".$currenttrait[4]."<br>";
		}
	}
	
	// Ethics
	if ($script == "ethics") {
		$ethics = gen_ethics(1);
		foreach($ethics as $currentethic) {
			echo "<img src=\"".$currentethic[2]."\"/> / ".$currentethic[1]." / ".$currentethic[5]."<br>";
		}
	}
	
	// Authority
	if ($script == "authority") {
		$authority = gen_authority(1);
		echo "<img src=\"".$authority[2]."\"/> / ".$authority[1]." / ".$authority[3]."<br>";
	}
?>