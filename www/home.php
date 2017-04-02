<?php
	
	session_start();
	$page_title = "Home";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view.php';

	$errors = [];

	if (array_key_exists('enter', $_POST)) {
		if (empty($_POST['cat'])) {
			$errors['cat'] = "Enter Category name";
		}
	if (empty($errors)) {
		// do database stuff

		$clean = array_map('trim', $_POST);

		insertCategory($conn, $clean);



	}
}






?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
<div class="wrapper">
		<div id="stream">

		<form id="register" action="home.php" method="POST">

			<label>Categories: </label>
			<input type="text" name="cat" placeholder="Enter Product Category">

			<input type="submit" name="enter" value="Enter">
		

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>
	<?php
	include 'includes/footer.php';

	?>

</body>
</html>