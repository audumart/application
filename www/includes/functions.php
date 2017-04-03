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
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

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
	function fileUpload($up){

		$ext = ["image/jpg", "image/jpeg", "image/png"];

		if (!in_array($_FILES['pic']['type'], $ext)) {
		$errors[] = "invalid file type";
	}

	# generate random number to append
	$rnd = rand(0000000000, 9999999999);

	# strip filename for spaces
	$strip_name = str_replace(" ", "_", $_FILES['pic']['name']);

	$filename = $rnd.$strip_name;
	$destination = 'uploads/'.$filename;

	# check file size...
	if ($_FILES['pic']['size'] > MAX_FILE_SIZE) {
		$errors[] = "file size exceeds maximum. maximum:". MAX_FILE_SIZE;
	}

	if(!move_uploaded_file($_FILES['pic']['tmp_name'], $destination)){
		$errors[] = "file upload failed";
	}
	# check extension
	if (!in_array($_FILES['pic']['type'], $ext)) {
		$errors[] = "invalid file type";
	}


	}

	function insertCategory($dbconn, $in){

		$stmt = $dbconn->prepare("INSERT INTO category(category_name) VALUES(:c)");

		$stmt->bindParam(":c", $in['category']);
		$stmt->execute();
	}

	function showCategory($dbconn){
		$stmt = $dbconn->prepare("SELECT * FROM category");
		$stmt->execute();
		$result = "";
		

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$category_id = $row['category_id'];
			$category_name = $row['category_name'];

			$result .="<tr>";
			$result .="<td>".$category_id."</td>";
			$result .="<td>".$category_name."</td>";

			$result .= "<td><a href='category.php?action=edit&category_id=$category_id&category_name=$category_name'>edit</a></td>";
			$result .= "<td><a href='category.php?act=delete&category_id=$category_id'>delete</a><td>";
			$result .= "<tr>";

		}
		return $result;
	}

	function editCategory($dbconn, $input){

		$stmt = $dbconn->prepare("UPDATE category SET category_name = :c WHERE category_id = :ci");
		$stmt->bindParam(":c", $input['category_name']);
		$stmt->bindParam(":ci", $input['category_id']);
		$stmt->execute();
		$success = "category edited!";
		header("Location:category.php?success=$success");
	}

	function deleteCat($dbconn, $del){

		$stmt = $dbconn->prepare("DELETE FROM category WHERE category_id = :ci");
		
		$stmt->bindParam(":ci", $del);
		$stmt->execute();
		$success = "category deleted!";
		header("Location:category.php?success=$success");
	}

	

?>