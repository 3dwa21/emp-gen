<?php

    function displayAlert($message="", $type="") {
        echo "<div class=\"alert alert-".$type." alert-dismissible\">";
        echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
        echo "<strong>".$message."</strong>";
        echo "</div>";
    }

    //===========================================================================//

?>