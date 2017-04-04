<?php 


session_start();
	$page_title = "Products";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view.php';


?>
<div class="wrapper">
		<div id="stream">
<h3>Available Products</h3>
	<table id="tab">
		<thead>
			<tr>
				<th>Book ID</th>
				<th>Title</th>
				<th>Author</th>
				<th>Price</th>
				<th>Year</th>
				<th>ISBN</th>
				<th>IMAGE</th>
				<th>edit</th>
				<th>delete</th>
			</tr>
		</thead>
		<tbody>
			<?php  $view = showProduct($conn); echo $view; ?>
		</tbody>
	</table>
		
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>

<?php
	include 'includes/footer.php';

	?>