<?php
    include("globals.php");
    include("helper.php");

    $userid = getUserID();
    $oldpw = $_POST['passwordcurrent'];
    $newpw = $_POST['password'];
    $newpwcheck = $_POST['passwordcheck'];

    $nocurrentpw = "";
    $nonewpw = "";
    $nonewpwcheck = "";
    $wrongcurrentpw = "";
    $mismatchnewpw = "";

    if ((strcmp($oldpw, "") != 0) && (strcmp($newpw, "") != 0) && (strcmp($newpwcheck, "") != 0)) {
        if (strcmp($newpw, $newpwcheck) == 0) {
            //Connecting
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);

            // Get Data
            $sql = "SELECT * FROM `users` WHERE `0_ID`=\"".$userid."\"";
            $stmt = $pdo->prepare($sql); 
            $stmt->execute(); 
            $row = $stmt->fetch();

            if (password_verify($oldpw, $row["2_password"])) {
                try {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $newpw = password_hash($newpw, PASSWORD_DEFAULT);
                    $sql = "UPDATE `users` SET `2_password` = \"".$newpw."\" WHERE 0_ID = ".$userid;
                    $pdo->exec($sql);

                    header("Location: ../html/user_profile.html?changeok=1");
	                die();

                } catch(PDOException $e) {
					echo "Connection failed: " . $e->getMessage();
				}
            } else {
                $wrongcurrentpw = "wrongcurrentpw=1";
            }
        } else {
            $mismatchnewpw = "mismatchnewpw=1";
        }
    } else {
        if (strcmp($oldpw, "") == 0) {
            $nocurrentpw = "nocurrentpw=1";
        }
        if (strcmp($newpw, "") == 0) {
            $nonewpw = "nonewpw=1";
        }
        if (strcmp($newpwcheck, "") == 0) {
            $nonewpwcheck = "nonewpwcheck=1";
        }
    }

    $errors = "?";
	if (strcmp($nocurrentpw, "") != 0) {
		$errors = $errors.$nocurrentpw."&";
	}
	if (strcmp($nonewpw, "") != 0) {
		$errors = $errors.$nonewpw."&";
	}
	if (strcmp($nonewpwcheck, "") != 0) {
		$errors = $errors.$nonewpwcheck."&";
    }
    if (strcmp($wrongcurrentpw, "") != 0) {
		$errors = $errors.$wrongcurrentpw."&";
    }
    if (strcmp($mismatchnewpw, "") != 0) {
		$errors = $errors.$mismatchnewpw."&";
    }
	
	$errors = rtrim($errors, "&");
	if (strcmp($errors, "?") == 0) {
		$errors = "";
    }
	header("Location: ../html/user_profile.html".$errors);
	die();
?>