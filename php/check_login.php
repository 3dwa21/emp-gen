<?php
	
	include("globals.php");
	if (!isset($_POST["logintry"])) {
		if(!isset($_COOKIE[$cookiename])) {
			header("Location: ../html/login.html?notloggedin=1");
			die();
		}
	} else {
		if(!isset($_COOKIE[$cookiename])) {
			$user = $_POST["user"];
			$password = $_POST["password"];
			
			//Connecting
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

			// Get Data
			$sql = "SELECT * FROM `users` WHERE `1_username`=\"".$user."\"";
			$stmt = $pdo->prepare($sql); 
			$stmt->execute(); 
			$row = $stmt->fetch();
			
			if ((strcmp($user,$row["1_username"]) == 0) && (password_verify($password, $row["2_password"]))) {
				$userid = $row["0_ID"];
				setcookie($cookiename,$user,time() + (86400 * 30), "/");
				setcookie($cookieid,$userid,time() + (86400 * 30), "/");
				header("Location: ../html/main.html");
				die();
			} else {
				header("Location: ../html/login.html?success=0");
				die();
			}
		} else {
			header("Location: ../html/login.html");
			die();
		}
	}

?>