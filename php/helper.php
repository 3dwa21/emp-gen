<?php

    function getUserName($calledfrommain = 0) {
        $path = "../";

        if ($calledfrommain == 1) {
            $path = "";
        }

        include("".$path."php/globals.php");
        if(isset($_COOKIE[$cookiename])) {
            return $_COOKIE[$cookiename];
        }
    }

    //===========================================================================//

    function displayDanger($dangerMessage) {
        echo "<div class=\"alert alert-danger alert-dismissible\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
        echo "<strong>".$dangerMessage."</strong>";
        echo "</div>";
    }

    //===========================================================================//

    function checkLoginLogout($calledfrommain = 0) {
        $path = "../";

        if ($calledfrommain == 1) {
            $path = "";
        }

        include($path."php/globals.php"); 
        if(isset($_COOKIE[$cookiename])) {
            return "<li><a class=\"nav-link\" href=\"".$path."php/logout.php\"><i class=\"fas fa-sign-out-alt\"></i> Logout</a></li>";
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

?>