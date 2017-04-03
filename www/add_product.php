<?php

	session_start();

	$page_title = "Add Category";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view.php';





?>

	<div class="wrapper">
		<div id="stream">
			<form id="register" method="POST" enctype="multipart/form-data">
				<p>Choose Book</p>
				<div>
					<input type="file" name="book">
				</div>

				<div>
					<label>Book Title</label>
					<input type="text" name="title" placeholder="Enter Book Title">
				</div>

				<div>
					<label>Author</label>
					<input type="text" name="author" placeholder="Enter Book Author(s)">
				</div>

				<div>
					<label>Price</label>
					<input type="text" name="price" placeholder="Enter Book price">
				</div>

				<div>
					<label>Year Of Publication</label>
					<input type="text" name="year" placeholder="Enter Year Of Publication">
				</div>

				<div>
					<label>ISBN</label>
					<input type="text" name="isbn" placeholder="Enter Book ISBN">
				</div>

				<div>
					<label>Select Category</label>
					<select name="category">
						<option>Select Category</option>
						<?php
						$stmt = $conn->prepare("SELECT * FROM category");
						$stmt->execute();
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
						<option value="<?php echo $row['category_name']?>"> <?php echo $row['category_name'] ?> </option>
						<?php } ?>
					</select>
				</div>

				<input type="submit" name="save" value="upload">
			</form>
		</div>
	</div>








<?php

	include 'includes/footer.php';

?>