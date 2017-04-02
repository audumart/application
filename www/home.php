<?php
	
	session_start();
	$page_title = "Home";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view.php';






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
			
			<label>Category: </label>
			<input type="text" name="cat" placeholder="Enter Product Category">

			<input type="submit" name="enter" value="Enter">
		</form>
			<table id="tab">
				<thead>
					<tr>
						<th>post title</th>
						<th>post author</th>
						<th>date created</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>the knowledge gap</td>
						<td>maja</td>
						<td>January, 10</td>
						<td><a href="#">edit</a></td>
						<td><a href="#">delete</a></td>
					</tr>
          		</tbody>
			</table>
		</div>

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