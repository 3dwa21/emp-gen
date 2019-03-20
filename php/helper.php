<?php

    /***********************************************
     * buildNavBar( $ismain=0 )
     * checkLoginLogout()
     * displayAllRecords()
     * getUserName()
     * getUserID()
     * loadMods()
     ***********************************************/

    function buildNavBar($ismain=0) {
        $username = getUserName();
        $userid = getUserID();

        $output = "<nav class=\"navbar navbar-expand-sm bg-dark navbar-dark fixed-top\">";
		$output = $output."<div class=\"navbar-header\">";
        $output = $output."<a class=\"navbar-brand\" href=\"user_profile.html\">";
        $output = $output.$username;
        $output = $output."</a>";
		$output = $output."</div>";
		$output = $output."<ul class=\"navbar-nav\">";
		$output = $output."<li><a class=\"nav-link\" href=\"main.html\"><strong>Home</strong></a></li>";
        $output = $output."<li><a class=\"nav-link\" href=\"mod_settings.html\">Mod-Settings</a></li>";
        if ($userid==1) {
            $output = $output."<li><a class=\"nav-link\" href=\"check_records.html\">Check Records</a></li>";
        }
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

    //===========================================================================//

    function checkLoginLogout() {
        include("globals.php"); 
        if(isset($_COOKIE[$cookiename])) {
            return "<li><a class=\"nav-link\" href=\"../php/logout.php\"><i class=\"fas fa-sign-out-alt\"></i> Logout</a></li>";
        } else {
            return "<li><a class=\"nav-link\" href=\"login.html\"><i class=\"fas fa-sign-in-alt\"></i> Login</a></li>";
        }
    }

    //===========================================================================//

    function displayAllRecords() {
        include("globals.php");
        include("parser.php");
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
        $output = "";

        // Authorities
        $output = $output."<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#authorities\">Authorities</button>";
        $output = $output."<div id=\"authorities\" class=\"collapse\">";

        $sql = "SELECT * FROM `authorities`";
		foreach ($pdo->query($sql) as $row) {
            $name = $row[1];
            $icon = $row[2];
            $description = $row[3];
            $description = parse_all($description,"description_imgs");

            $output = $output.$name."<br><img src=\"../resources/img/authority_imgs/".$icon.".png\"><br>".$description."<br><br>";
        }
        $output = $output."</div><br><br>";

        // Planet - Citystyle
        $output = $output."<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#citystyles\">City-Styles</button>";
        $output = $output."<div id=\"citystyles\" class=\"collapse\">";

        $sqlplanets = "SELECT * FROM `planets`";
        $sqlstyles = "SELECT * FROM `citystyle`";

		foreach ($pdo->query($sqlplanets) as $row) {
            $nameplanet = $row[1];
            foreach ($pdo->query($sqlstyles) as $row) {
                $namestyle = $row[1];
                $linkpart = $row[3];
                $link = strtolower($nameplanet)."_".$linkpart;

                $output = $output.$nameplanet." - ".$namestyle."<br><img src=\"../resources/img/city_styles_imgs/".$link.".bmp\"><br><br>";
            }
        }
        $output = $output."</div><br><br>";

        // Ethics
        $output = $output."<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#ethics\">Ethics</button>";
        $output = $output."<div id=\"ethics\" class=\"collapse\">";

        $sql = "SELECT * FROM `ethics`";
		foreach ($pdo->query($sql) as $row) {
            $name = $row[1];
            $icon = $row[2];
            $description = $row[5];
            $description = parse_all($description,"description_imgs");

            $output = $output.$name."<br><img src=\"../resources/img/ethics_imgs/".$icon.".png\"><br>".$description."<br><br>";
        }
        $output = $output."</div><br><br>";

        // Phenotypes
        $output = $output."<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#phenotypes\">Phenotypes</button>";
        $output = $output."<div id=\"phenotypes\" class=\"collapse\">";

        $sql = "SELECT * FROM `phenotypes`";
		foreach ($pdo->query($sql) as $row) {
            $imagename = $row[2];

            $output = $output."<img src=\"../resources/img/species_imgs/".$imagename.".bmp\"><br><br>";
        }
        $output = $output."</div><br><br>";

        // Ships
        $output = $output."<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#ships\">Ships</button>";
        $output = $output."<div id=\"ships\" class=\"collapse\">";

        $sql = "SELECT * FROM `ships`";
		foreach ($pdo->query($sql) as $row) {
            $imagename = $row[3];

            $output = $output."<img src=\"../resources/img/ships_imgs/".$imagename.".bmp\"><br><br>";
        }
        $output = $output."</div><br><br>";

        // Traits
        $output = $output."<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#traits\">Traits</button>";
        $output = $output."<div id=\"traits\" class=\"collapse\">";

        $sql = "SELECT * FROM `traits`";
		foreach ($pdo->query($sql) as $row) {
            $name = $row[1];
            $icon = $row[6];
            $description = $row[4];
            $description = parse_all($description,"description_imgs");

            $output = $output.$name."<br><img src=\"../resources/img/traits_imgs/".$icon.".png\"><br>".$description."<br><br>";
        }
        $output = $output."</div><br><br>";

        return $output;
    }

    //===========================================================================//

    function getUserName() {
        include("globals.php");
        if(isset($_COOKIE[$cookiename])) {
            return $_COOKIE[$cookiename];
        }
    }

    //===========================================================================//

    function getUserID() {
        include("globals.php");
        if(isset($_COOKIE[$cookieid])) {
            return $_COOKIE[$cookieid];
        }
    }

    //===========================================================================//

    function loadMods() {
        include("globals.php");

        $output = "";
								
        // get and display data from database
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

        $user_id = $_COOKIE[$cookieid];
        $sql = "SELECT * FROM `usersettings` WHERE `0_userid` = ".$user_id;
		$stmt = $pdo->prepare($sql); 
		$stmt->execute(); 
        $row = $stmt->fetch();
        $activemods = $row['1_active_mods'];
        $activemods = explode(",",$activemods);

        $sql = "SELECT * FROM mods";
        
        $output = $output."<table>";
        
        $numofmods = 0;
        foreach ($pdo->query($sql) as $row) {
        
            // check if current mod is set active
            $checked = "";
            $modid = $row["0_ID"];
            foreach ($activemods as $mod_row) {
                if ($mod_row[0] == $modid) {
                    $checked = " checked";
                }
            }
            $modname = $row["1_name"];
            
            
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

?>