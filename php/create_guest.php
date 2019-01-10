<?php

	include("globals.php");
	
	$password = password_hash("guest_password", PASSWORD_DEFAULT);
	try {
		$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$username = "Guest";
		$sql = "INSERT INTO `users` (`1_username`,`2_password`) VALUES ('$username','$password')";
		echo $sql;
		$pdo->exec($sql);
		
		$userid = $pdo->lastInsertId();
		$username = $username." ".$userid;
		
		setcookie($cookiename,$username,time() + (86400 * 30), "/");
		
		header("Location: ../main.html");
		die();
		
	} catch(PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

?>