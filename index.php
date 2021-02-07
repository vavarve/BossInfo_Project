<?php include("includes/header.php");?>
  
<?php include("includes/navbar.php");?>


<!-- Input filter -->
<div class="container">
  <form class="form">
    <div class="input-field">
      <input id="search" type="search" required placeholder="Search bookings by room..." onkeyup="myFunction()">
      <label class="label-icon" for="search"><i class="material-icons"></i></label>
      <i class="material-icons">cancel</i>
    </div>
  </form>
<div>


<!-- Table with all bookings     -->
<div class="container">
  <h1 class="center-align">Bookings</h1>
  <!-- Table -->
  <table class="table" id="myTable">
    <thead>
      <tr>
          <th>Room</th>
          <th>Full Name</th>
          <th>From</th>
          <th>Until</th>
      </tr>
    </thead>
    <tbody>

    <?php
    // Query to fetch rooms from database joinig the rooms and bookings tables
      $query = "SELECT bookings.book_id, rooms.room_name, bookings.full_name, bookings.from_date, bookings.until_date FROM bookings INNER JOIN rooms ON bookings.room_id = rooms.room_id";
      $result = mysqli_query($connection, $query);

      if(!$result){
        die("QUERY FAILED ") . mysqli_error($connection);
      }

      while($row = mysqli_fetch_array($result)):
        $book_id = $row['book_id'];
        $room_name = $row['room_name'];
        $full_name = $row['full_name'];
        $from_date = $row['from_date'];
        $until_date = $row['until_date'];

    ?>
      <tr>
        <td><?= $room_name; ?></td>
        <td><?= $full_name; ?></td>
        <td><?= $from_date; ?></td>
        <td><?= $until_date; ?></td>
      </tr>
      <?php endwhile; ?>

    </tbody>
  </table>

</div>

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

 <script>
 // Script for the input filter
    function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
 </script>
</body>
</html>