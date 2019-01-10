<?php
	include("globals.php");

	$username = $_POST['username'];
	$password = $_POST['password'];
	$passwordcheck = $_POST['passwordcheck'];
	
	$nouser = "";
	$nopw = "";
	$nopwc = "";
	$taken = "";
	$fixpw = "";
	
	if (strcmp($username,"") == 0) {
		$nouser = "nouser=1";
	}
	if (strcmp($password,"") == 0) {
		$nopw = "nopw=1";
	}
	if (strcmp($passwordcheck,"") == 0) {
		$nopwc = "nopwc=1";
	}
	
	if ((strcmp($nouser,"") == 0) AND (strcmp($nopw,"") == 0) AND (strcmp($nopwc,"") == 0)) {
		if (strcmp($password, $passwordcheck) == 0) {		
			//Connecting
			$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

			// Get Data
			$sql = "SELECT * FROM `users` WHERE `1_username`=\"".$username."\"";
			$stmt = $pdo->prepare($sql); 
			$stmt->execute(); 
			$row = $stmt->fetch();

			if (strcmp($username,$row["1_username"]) == 0) {
				$taken = "taken=1";
			} else {
				$password = password_hash($password, PASSWORD_DEFAULT);
				try {
					$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$sql = "INSERT INTO `users` (`1_username`,`2_password`) VALUES ('$username','$password')";
					echo $sql;
					$pdo->exec($sql);
					
					header("Location: ../html/login.html?success=1");
					die();
					
				} catch(PDOException $e) {
					echo "Connection failed: " . $e->getMessage();
				}
			}
		} else {
			$fixpw = "fixpw=1";
		}
	}
	
	$errors = "?";
	if (strcmp($nouser,"") != 0) {
		$errors = $errors.$nouser."&";
	}
	if (strcmp($nopw,"") != 0) {
		$errors = $errors.$nopw."&";
	}
	if (strcmp($nopwc,"") != 0) {
		$errors = $errors.$nopwc."&";
	}
	if (strcmp($taken,"") != 0) {
		$errors = $errors.$taken."&";
	}
	if (strcmp($fixpw,"") != 0) {
		$errors = $errors.$fixpw."&";
	}
	
	$errors = rtrim($errors,"&");
	if (strcmp($errors,"?") == 0) {
		$errors = "";
	}
	header("Location: ../html/new_user.html".$errors);
	die();
?>