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

# allowed extensions...
$ext = ["image/jpg", "image/jpeg", "image/png"];



	if (array_key_exists('save', $_POST)) {

		$errors = [];
	# be sure if a file was selected
	if (empty($_FILES['pic']['name'])) {
		$errors[] = "please choose a file";
	}
	# check file size...
	if ($_FILES['pic']['size'] > MAX_FILE_SIZE) {
		$errors[] = "file size exceeds maximum. maximum:". MAX_FILE_SIZE;
	}
	# check extension
	if (!in_array($_FILES['pic']['type'], $ext)) {
		$errors[] = "invalid file type";
	}

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





