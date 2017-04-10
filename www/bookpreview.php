<?php
		session_start();

		$page_title = "Book Preview";
		
		# load db connection
		include 'includes/db.php';
		# load function
		include 'includes/functions.php';
		# include header
		include 'includes/indexheader.php';
		
		$user_id = $_SESSION['user_id'];
		if(isset($_GET['book_id'])){
			$show = getBookByID($conn, $_GET['book_id']);
		}

				if(array_key_exists('submit', $_POST)) {
			$clean = array_map('trim', $_POST);
				$stmt = $conn->prepare("INSERT INTO preview(user_id, book_id, review) VALUES(:us, :bk, :re,");
				$data = [':us' => $user_id,
						 ':bk' => $show['book_id'],
						 're' => $clean['review'],
						];
				$stmt->execute($data);
		}
			$errors = [];
		if(array_key_exists('enter', $_POST)) {
			if(empty($_POST['quantity'])) {
				$errors['quantity'] = "You have not chosen any amount!";
			} else {
				redirect("cart.php");
			}
		}
		
			
			
		
?>

<div class="main">
    <p class="global-error"></p>
    <div class="book-display">
     <div class="display-book" style="background: url('../<?php echo $show['file_path']; ?>');background-size: contain;background-position: center;background-repeat: no-repeat;"></div>
      <div class="info">

      <h2 class="book-title"><?php echo $show['title']; ?></h2>
      <h2 class="book-title"><?php echo $show['author']; ?></h2>
      <h2 class="book-title"><?php echo $show['price']; ?></h2>
      
        
        <form action="" method="POST">
          <label for="book-amout">Amount</label>
          <input type="number" class="book-amount text-field" name="quantity" >
          <input class="def-button add-to-cart" type="submit" name="enter" value="Add to cart">
        </form>
      </div>
    </div>
    <div class="book-reviews">
      <h3 class="header">Reviews</h3>
      <ul class="review-list">

	<?php
      				$com = comment($conn, $show['book_id']);
      				echo $com;
      		 ?>      		
       
      </ul>
      <div class="add-comment">
        <h3 class="header">Add your comment</h3>
        <form class="comment" action="" method="POST">
          <textarea class="text-field" name="review" placeholder="write something"></textarea>

         <!-- <button class="def-button post-comment" type="button" name="submit">Upload comment</button> -->

         <input type="submit" class="def-button post-comment" name="submit" value="Upload comment">
        </form>
      </div>
    </div>
  </div>
