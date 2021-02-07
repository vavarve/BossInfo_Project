<nav>
    <div class="nav-wrapper blue-grey">
      <div class="container">
      <a href="index.php" class="brand-logo">Lorem Ipsum Booking</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="index.php">Home</a></li>
        <li><a href="book.php">Booking Page</a></li>
        <li><a href="about.php">About</a></li>

        <?php
          if(isset($_SESSION['username'])){
            echo '<li><a href="admin.php">Admin</a></li>';
          }else {
            echo '<li><a href="login.php">Admin</a></li>';
          }
        ?>
        
        <?php
          if(isset($_SESSION['username'])){
            echo '<li><a href="logout.php">Logout</a></li>';
          }
        ?>
        
      </ul>
    </div>
  </div>
</nav>