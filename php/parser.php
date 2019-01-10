<?php
	
	function parse_all($input_text,$folder) {
		$input_text = parse_icons($input_text,$folder);
		$input_text = parse_color($input_text);
		$input_text = parse_linebreak($input_text);
		
		return $input_text;
	}
	
	//===========================================================================//
	
	function parse_icons($input_text,$input_folder) {
		
		$found = strpos($input_text,"[[IC:");
		while ($found > -1) {
			$folder = $input_folder;
			
			$foundend = strpos($input_text,"]]",$found);
			$lengthicon = $foundend - ($found + 5);
			$icon = substr($input_text,$found + 5,$lengthicon);
			
			$foundsemikolon = strpos($icon,";");
			if ($foundsemikolon > -1) {
				$icon = explode(";",$icon);
				$folder = $icon[1];
				$icon = $icon[0];
			}
			
			$icon_path = "resources/img/".$folder."/".$icon.".png";
			$html_block = "<img src=\"".$icon_path."\" width=\"22\" height=\"22\"/>";
			
			$lengthreplace = ($foundend + 2) - $found;
			$replacepart = substr($input_text,$found,$lengthreplace);
			$input_text = str_replace($replacepart,$html_block,$input_text);
			
			$found = strpos($input_text,"[[IC:");
		}
	
		return $input_text;
	}
	
	//===========================================================================//
	
	function parse_color($input_text) {
	
		$found = strpos($input_text,"[[#");
		while ($found > -1) {
			$foundend = strpos($input_text,"]]",$found);
			$lengthformat = $foundend - ($found + 2);
			$formattext = substr($input_text,$found + 2,$lengthformat);
			$formattext = explode(";",$formattext);
			$html_block = "<font color=\"".$formattext[0]."\"/><b>".$formattext[1]."</b></font>";
			
			$lengthreplace = ($foundend + 2) - $found;
			$replacepart = substr($input_text,$found,$lengthreplace);
			$input_text = str_replace($replacepart,$html_block,$input_text);
			
			$found = strpos($input_text,"[[#");
		}
	
		return $input_text;
	
	}
	
	//===========================================================================//
	
	function parse_linebreak($input_text) {
	
		$placeholder = "[[LB]]";
	
		$found = strpos($input_text,$placeholder);
		while ($found > -1) {
			
			$html_block = "<br>";
			$input_text = str_replace("[[LB]]",$html_block,$input_text);
			
			$found = strpos($input_text,$placeholder);
		}
	
		return $input_text;
	
	}
	
?>