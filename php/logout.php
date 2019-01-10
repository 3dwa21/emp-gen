<?php
	
	include("globals.php");
	$actuser = $_COOKIE[$cookiename];
	$actuserid = $_COOKIE[$cookieid];
	setcookie($cookiename, $actuser, time() - 3600, "/");
	setcookie($cookieid, $actuserid, time() - 3600, "/");
	
	header("Location: ../html/login.html");
	die();
	
?>