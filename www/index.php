<?php
  
  include 'includes/db.php';

  include 'includes/indexheader.php';

  include 'includes/functions.php';

  include 'includes/indexfooter.php';

  $show = showTop($conn);
?>

  <!-- main content starts here -->
  <div class="main">
    <div class="book-display">
      <div class="display-book" style="background: url('uploads/692837750hack5.jpeg');background-size: contain;background-position: center;background-repeat: no-repeat;"></div>
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

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <li class="book">
          <a href="#"><div class="book-cover" style="background: url('uploa');background-size: contain;background-position: center;background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p></p></div>
        </li>

        <?php } ?>

        <li class="book">
          <a href="#"><div class="book-cover" style="background: url('uploads/6271725744cssbook6.jpeg');background-size: contain;background-position: center;background-repeat: no-repeat;""></div></a>
          <div class="book-price"><p>$110</p></div>
        </li>

        <li class="book">
          <a href="#"><div class="book-cover" style="background: url('uploads/6819613636cssbook5.jpeg');background-size: contain;background-position: center;background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p>$65</p></div>
        </li>

        <li class="book">
          <a href="#"><div class="book-cover"  style="background: url('uploads/758902886cssbook2.jpeg');background-size: contain;background-position: center;background-repeat: no-repeat;"></div></a>
          <div class="book-price"><p>$70</p></div>
        </li>
      </ul>
    </div>
    <div class="recently-viewed-books horizontal-book-list">
      <h3 class="header">Recently Viewed</h3>
      <ul class="book-list">
        <div class="scroll-back"></div>
        <div class="scroll-front"></div>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$250</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$50</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$125</p></div>
        </li>
        <li class="book">
          <a href="#"><div class="book-cover"></div></a>
          <div class="book-price"><p>$90</p></div>
        </li>
      </ul>
    </div>
    
  </div>
  