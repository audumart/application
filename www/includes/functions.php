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

	function addProduct($dbconn, $add){
		define('MAX_FILE_SIZE', '2097152');

		$ext = ["image/jpg", "image/jpeg", "image/png"];

		$rnd = rand(0000000000, 9999999999);

		$strip_name = str_replace(" ", " _ ", $_FILES['book']['name']);

		$filename = $rnd.$strip_name;
		$destination = 'uploads/'.$filename;

			if (array_key_exists('save', $_POST)) {

				$errors = [];

			
			if (empty($_FILES['book']['name'])) {
				$errors[] = "Please choose a file";
			}

		if ($_FILES['book']['size'] > MAX_FILE_SIZE ) {
			$errors[] = "file size exceeds maximum. maximum: ". MAX_FILE_SIZE;
		}
		if (!in_array($_FILES['book']['type'], $ext)) {
			$errors[] = "invalid file type";
		}
		if (empty($errors)) {
			if (!move_uploaded_file($_FILES['book']['tmp_name'], $destination)) {
				$errors[] = "file upload failed";
			}
		echo "done";
		}
		else{
			foreach ($errors as $err) {
				echo $err. '</br>';
			}
		}
	}
		

		
		$state = $dbconn->prepare("SELECT category_id FROM category WHERE category_name = :c");
		$state->bindParam(":c", $add['category']);
		$state->execute();

		$row = $state->fetch(PDO::FETCH_ASSOC);
		$category_id = $row['category_id'];

		$stmt = $dbconn->prepare("INSERT INTO products(title, author, category_id, price, year, isbn, file_path)
											VALUES(:ti, :au, :ci, :pr, :yr, :is, :fi)");
		$data = [

			':ti' => $add['title'],
			':au' => $add['author'],
			'ci' => $category_id,
			':pr' => $add['price'],
			':yr' => $add['year'],
			':is' => $add['isbn'],
			':fi' => $destination

				];

			$stmt->execute($data);
	}

	function showProduct($dbconn){
		$stmt = $dbconn->prepare("SELECT * FROM products");
		$stmt->execute();
		$result = "";
		

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$book_id = $row['book_id'];
			$title = $row['title'];
			$author = $row['author'];
			$price = $row['price'];
			$year = $row['year'];
			$isbn = $row['isbn'];



			$result .="<tr>";
			$result .="<td>".$book_id."</td>";
			$result .="<td>".$title."</td>";
			$result .="<td>".$author."</td>";
			$result .="<td>".$price."</td>";
			$result .="<td>".$year."</td>";
			$result .="<td>".$isbn."</td>";
			$result .='<td><img src="'.$row['file_path'].'" height="60" width="60"></td>';



			$result .= "<td><a href='view_product.php?action=edit&book_id=$book_id&title=$title'>edit</a></td>";
			$result .= "<td><a href='view_product.php?act=delete&book_id=$book_id'>delete</a><td>";
			$result .= "<tr>";

		}
		return $result;
	}

	function editProduct($dbconn, $input){

		$stmt = $dbconn->prepare("UPDATE products SET title= :ti WHERE book_id = :bi");
		$stmt->bindParam(":ti", $input['title']);
		$stmt->bindParam(":bi", $input['book_id']);
		$stmt->execute();
		$success = "product edited!";
		header("Location:view_product.php?success=$success");
	}


?>