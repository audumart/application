<?php # test.php sandbox

/*define('DBNAME', 'martin');
define('DBUSER', 'root');
define('DBPASS', 'root');



try{
	# prepare a pdo instance
	$conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

	# set verbose error modes
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
} catch(PDOException $e){
	echo $e->getMessage();
}*/
# max file size
define('MAX_FILE_SIZE', "2097152");

# include function
include 'includes/functions.php';


	if (array_key_exists('save', $_POST)) {

		$errors = [];
	# be sure if a file was selected
	if (empty($_FILES['pic']['name'])) {
		$errors[] = "please choose a file";
	}
	
	
	fileUpload($_FILES);
	

	if (empty($errors)) {
		echo "done";
	} else {
		foreach ($errors as $err) {
			echo $err. '</br>';
		}
	}
}

?>

<form id="register" method="POST" enctype="multipart/form-data">
	<p>please upload a file</p>
	<input type="file" name="pic">

	<input type="submit" name="save">

	</form>





