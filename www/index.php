<?php
  
  session_start();
  
  include 'includes/db.php';

  include 'includes/indexheader.php';

  include 'includes/functions.php';

  include 'includes/indexfooter.php';

  $show = showTop($conn);
?>

  <!-- main content starts here -->
  <div class="main">
    <div class="book-display">
      <div class="display-book" style="background: url('../<?php echo $show['file_path']; ?>');background-size: contain;background-position: center;background-repeat: no-repeat;"></div>
      <div class="info">

      <h2 class="book-title"><?php echo $show['title']; ?></h2>
      <h2 class="book-title"><?php echo $show['author']; ?></h2>
      <h2 class="book-title"><?php echo $show['price']; ?></h2>
      

        <form>
          <label for="book-amout">Amount</label>
          <input type="number" class="book-amount text-field">
          <input class="def-button add-to-cart" type="submit" name="" value="Add to cart">
        </form>
      </div>
    </div>
    <div class="trending-books horizontal-book-list">
      <h3 class="header">Trending</h3>
      <ul class="book-list">
        
      <?php
      $t = "Trending";

      $stmt = $conn->prepare("SELECT * FROM products WHERE flag=:fl");
      $stmt->bindParam(':fl', $t);

      $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

        $book_id = $row['book_id'];
          ?>
        <li class="book">
          <a href="bookpreview.php?book_id=$book_id"><div class="book-cover" style="background: url('../<?php echo $row['file_path']; ?>'); 
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;">
          </div></a>
          <div class="book-price"><p>
            <?php echo $row['price']; ?>
          </p></div>
        </li>

        <?php } ?>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
      <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>
        <?php
      $r = "recently viewed";

      $stmt = $conn->prepare("SELECT * FROM products WHERE flag=:fl");
      $stmt->bindParam(':fl', $r);

      $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <li class="book">
          <a href="bookpreview.php?book_id=$book_id"><div class="book-cover" style="background: url('../<?php echo $row['file_path']; ?>'); 
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;">
          </div></a>
          <div class="book-price"><p>
            <?php echo $row['price']; ?>
          </p></div>
        </li>

        <?php } ?>
        
    
  </div>
  