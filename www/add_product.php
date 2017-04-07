<?php

	session_start();

	$flag = array("trending" , "recently viewed", "top selling");



	$page_title = "Add Product";

	include 'includes/db.php';

	include 'includes/functions.php';

	include 'includes/view.php';

	$errors = [];

	if (array_key_exists('save', $_POST)) {

		
		if (empty($_POST['title'])) {
			$errors['title'] = "Enter Book Title";
		}
		if (empty($_POST['author'])) {
			$errors['author'] = "Enter Book Author(s)";
		}
		if (empty($_POST['price'])) {
			$errors['price'] = "Enter Book Price";
		}
		if (empty($_POST['year'])) {
			$errors['year'] = "Enter Year of Publication";
		}
		if (empty($_POST['isbn'])) {
			$errors['isbn'] = "Enter Book ISBN";
		}
		if (empty($errors)) {
			$clean = array_map('trim', $_POST);

			addProduct($conn, $clean);
		}
	}



?>

	<div class="wrapper">
		<div id="stream">
			<form id="register" method="POST" enctype="multipart/form-data">
				<p>Choose Book</p>
				<div>
					<input type="file" name="book">
				</div>

				<div>
				<?php
			$display = displayErrors($errors,'title');
			echo $display;
			?>
					<label>Book Title</label>
					<input type="text" name="title" placeholder="Enter Book Title">
				</div>

				<div>
				<?php
			$display = displayErrors($errors,'author');
			echo $display;
			?>
					<label>Author</label>
					<input type="text" name="author" placeholder="Enter Book Author(s)">
				</div>

				<div>
				<?php
			$display = displayErrors($errors,'price');
			echo $display;
			?>
					<label>Price</label>
					<input type="text" name="price" placeholder="Enter Book price">
				</div>

				<div>
				<?php
			$display = displayErrors($errors,'year');
			echo $display;
			?>
					<label>Year Of Publication</label>
					<input type="text" name="year" placeholder="Enter Year Of Publication">
				</div>

				<div>
				<?php
			$display = displayErrors($errors,'isbn');
			echo $display;
			?>
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
					<div>
				<div>
					<label>Book Status</label>
					<select name="flag"> 
					<option> Status 
					<?php foreach( $flag as $flag){?>
        				<option value="<?php echo $flag?>"><?php echo $flag ?></option>
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