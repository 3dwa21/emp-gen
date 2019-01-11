<?php

    function getUserName() {
        include("../php/globals.php");
        if(isset($_COOKIE[$cookiename])) {
            return $_COOKIE[$cookiename];
        }
    }

    //===========================================================================//

    function checkLoginLogout() {
        include("../php/globals.php"); 
        if(isset($_COOKIE[$cookiename])) {
            return "<li><a class=\"nav-link\" href=\"../php/logout.php\"><i class=\"fas fa-sign-out-alt\"></i> Logout</a></li>";
        } else {
            return "<li><a class=\"nav-link\" href=\"login.html\"><i class=\"fas fa-sign-in-alt\"></i> Login</a></li>";
        }
    }

    //===========================================================================//

    function loadMods() {
        include("globals.php");

        $output = "";
								
        // get and display data from database
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $sql = "SELECT * FROM mods";
        
        $output = $output."<table>";
        
        $numofmods = 0;
        foreach ($pdo->query($sql) as $row) {
        
            // check if current mod is set active
            $checked = "";
            if ($row["2_active"] == 1) {
                $checked = " checked";
            }
            $modname = $row["1_name"];
            $modid = $row["0_ID"];
            
            $output = $output."<tr><td><input type=\"hidden\" name=\"".$modid."\" value=\"0\">";
            $output = $output."<input type=\"checkbox\" name=\"".$modid."\" value=\"1\"".$checked."> ".$modname."</td></tr>";
        
            $numofmods++;
        }
        
        $output = $output."</table><br><br>";
        $output = $output."<input type=\"hidden\" name=\"modcounter\" value=\"".$numofmods."\">";
        $output = $output."<button type=\"submit\" class=\"btn btn-success btn-lg\">Save</button";

        return $output;
    }

    //===========================================================================//

    function buildNavBar($ismain=0) {
        $username = getUserName();

        $output = "<nav class=\"navbar navbar-expand-sm bg-dark navbar-dark fixed-top\">";
		$output = $output."<div class=\"navbar-header\">";
        $output = $output."<a class=\"navbar-brand\" href=\"#\">";
        $output = $output.$username;
        $output = $output."</a>";
		$output = $output."</div>";
		$output = $output."<ul class=\"navbar-nav\">";
		$output = $output."<li><a class=\"nav-link\" href=\"main.html\"><strong>Home</strong></a></li>";
        $output = $output."<li><a class=\"nav-link\" href=\"mod_settings.html\">Mod-Settings</a></li>";
        if ($ismain==1) {
            $output = $output."<li class=\"reset_button\"><a class=\"nav-link\" href=\"main.html\">Reset</a></li>";
        }
		$output = $output."</ul>";
		$output = $output."<ul class=\"navbar-nav ml-auto\">";
		$output = $output. checkLoginLogout();
        $output = $output."</ul>";
        $output = $output."</nav>";

        return $output;
    }

?>