<?php

	function doAdminRegister($dbconn, $input){
	# hash the password
	$hash = password_hash($input['password'], PASSWORD_BCRYPT);

	#insert data
	$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:fn, :ln, :e, :h)");
 	# bind params
 	$data = [

 	':fn' => $input['fname'],
 	':ln' => $input['lname'],
 	':e' => $input['email'],
 	':h' => $hash

 	];

 	$stmt->execute($data);	
	}

	function doesEmailExist($dbconn, $email) {
		$result = false;

		$stmt = $dbconn->prepare("SELECT email FROM admin WHERE 	email=:e");
		# bind params
		$stmt->bindParam(":e", $email);
		$stmt->execute();

		# get number of rows returned
		$count = $stmt->rowCount();

		if ($count > 0) {
			$result = true;
		}

		return $result;

	}

	function displayErrors($open, $name){
		$result = "";

		if (isset($open[$name])) {
			
			$result = '<span class="err">'.$open[$name].'</span>';
		}

		return $result;
	}

	function adminLogin ($dbconn, $enter){

		# prepared statement
		$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email=:e");

		#bind params
		$stmt->bindParam(":e", $enter['email']);
		$stmt->execute();

		$count = $stmt->rowCount();

		if ($count == 1) {
			$row = $statement->fetch(PDO::FETCH_ASSOC);

			if (password_verify($enter['password'], $row['hash'])) {
				$_SESSION['id'] = $row['admin'];
				$_SESSION['email'] = $row['email'];

				header("Location:home.php");
			}
		else {
			$login_error = "wrong email address or password";
			header("Location:login.php?login_error=$login_error");

		
			}	
		}
	}


?>