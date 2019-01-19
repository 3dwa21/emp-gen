<?php

	include("globals.php");
	
	$password = password_hash("guest_password", PASSWORD_DEFAULT);
	try {
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$username = "Guest";
		$sql = "INSERT INTO `users` (`1_username`,`2_password`) VALUES ('$username','$password')";
		$pdo->exec($sql);
		
		$userid = $pdo->lastInsertId();
		$username = $username." ".$userid;

		$sql = "INSERT INTO `usersettings`(`0_userid`,`1_active_mods`) VALUES ('$userid','0')";
		$pdo->exec($sql);
		
		setcookie($cookiename,$username,time() + (86400 * 30), "/");
		setcookie($cookieid,$userid,time() + (86400 * 30), "/");
		
		header("Location: ../html/main.html");
		die();
		
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

?>