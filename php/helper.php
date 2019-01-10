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
            return "<li><a href=\"".$path."php/logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>";
        } else {
            return "<li><a href=\"login.html\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
        }
    }

    //===========================================================================//

?>