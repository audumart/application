<?php 


session_start();
	$page_title = "Categories";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view.php';


?>
<div class="wrapper">
		<div id="stream">
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

<?php
	include 'includes/footer.php';

	?>