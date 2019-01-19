<?php

    include("run_generation.php");

    function get_options($category, $parameter1, $parameter2) {
        $output = "";

        if ($category == "traits") {
            $output = $output."<div class=\"col-xs-1\">";
            $output = $output."<label for=\"".$parameter1."\">Min. Traits</label>";
            $output = $output."<input class=\"form-control\" id=\"".$parameter1."\" type=\"number\" value=\"0\" onchange=\"checkMinMaxTraits()\">";
            $output = $output."</div>";
            $output = $output."<div class=\"col-xs-1\">";
            $output = $output."<label for=\"".$parameter2."\">Max. Traits</label>";
            $output = $output."<input class=\"form-control\" id=\"".$parameter2."\" type=\"number\" value=\"5\" onchange=\"checkMinMaxTraits()\">";
            $output = $output."</div>";
        }

        if (strlen($output) == 0) {
            $output = "No Options!";
        }

        return $output;
    }

    function output_with_button($category, $options, $parameter1, $parameter1default, $parameter2, $parameter2default) {
        $output = "";
        $output = $output."<div id=\"".$category."\">";
        $output = $output.run_generation($category, $parameter1default, $parameter2default);
        $output = $output."</div>";
        $output = $output."<form><div class=\"btn-group\" id=\"".$category."_btngroup\">";
        $output = $output."<button type=\"button\" class=\"btn btn-primary\" onclick=\"regenerate('".$category."','".$parameter1."','".$parameter2."')\">Regenerate</button>";
        $output = $output."<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"collapse\" data-target=\"#".$category."_options\">Options</button>";
        $output = $output."</div><br>";

        $output = $output."<div id=\"".$category."_options\" class=\"collapse\">";
        $output = $output."<div class=\"card\">";
        $output = $output."<div class=\"card-body\">";
        $output = $output."<div class=\"form-group row\">";
        $output = $output.get_options($category, $parameter1, $parameter2);
        $output = $output."</div></div></div></div></form>";
        $output = $output."<br>";

        return $output;
    }

    $categories;
    $handle = fopen("../resources/csv/categories.csv", "r");
    while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
        $categories[] = $data;
    }
    fclose($handle);

    $output = "";
    foreach($categories as $row) {
        $output = $output.output_with_button($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
    }

    echo $output;

?>