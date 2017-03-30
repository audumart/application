<?php

	function doAdminRegister($dbconn, $input){
	# hash the password
	$hash = password_hash($input['password'], PASSWORD_BCRYPT);

	#insert data
	$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:fn, :ln, :e, :h)");
 	# bind params
 	$data = [

 	':fn' => $clean['fname'],
 	':ln' => $clean['lname'],
 	':e' => $clean['email'],
 	':h' => $hash

 	];

 	$stmt->execute($data);	
	}


?>