<?php
	
	session_start();
	$page_title = "Categories";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view.php';

	$errors = [];

	if (array_key_exists('enter', $_POST)) {
		$clean = array_map('trim', $_POST);
		insertCategory($conn, $clean);
		}
	if (array_key_exists('edit', $_POST)) {
		$clean = array_map('trim', $_POST);
		editCategory($conn, $clean);
	}
	if (isset($_GET['success'])) {
		echo $_GET['success'];
	}
?>
<div class="wrapper">
		<div id="stream"><br/><br/>
		<p> 
		<?php

		if (isset($_GET['action'])) {
			if ($_GET['action'] = "edit") {
				
			
		



		?>
		<h3>Edit Category</h3>
			<form id="register" method="POST" action="category.php">
				<input type="text" name="category" placeholder="Category Name" value="<?php echo $_GET['cat'];   ?>" />
				<input type="hidden" name="category_id" value="<?php echo $_GET['category_id'];  ?>">
				<input type="submit" name="edit">
			</form>
			<?php
		}
	}

	if (isset($_GET['act'])) {
		if ($_GET['act'] = "delete") {
			deleteCat($conn, $_GET['category_id']);
		}
	}

			?>
		<h3>Add Category</h3>
		<form id="register" method="POST" action="category.php">
			<input type="text" name="cat" placeholder="Category Name" />
			<input type="submit" name="enter" value="Add">
		</form>
		</p>
	<hr>
	<h3>Available Categories</h3>
	<table id="tab">
		<thead>
			<tr>
				<th>Category ID</th>
				<th>Category Name</th>
				<th>edit</th>
				<th>delete</th>
			</tr>
		</thead>
		<tbody>
			<?php  $view = showCategory($conn); echo $view; ?>
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