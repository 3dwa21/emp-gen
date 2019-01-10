<?php
	
	include("globals.php");
	if (!isset($_POST["logintry"])) {
		if(!isset($_COOKIE[$cookiename])) {
			$path = "login.html?notloggedin=1";
			
			if (isset($pathextra)) {
				$path = $pathextra.$path;
			} else {
				$path = "../html/".$path;
			}
			
			header("Location: $path");
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
				header("Location: ../main.html");
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