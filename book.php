<?php include("includes/header.php");?>
  
<?php include("includes/navbar.php");?>


<?php

    // Message Vars 
    $msg = '';
    $msgClass = '';

    if(isset($_POST['submit'])){
        $from_date = htmlspecialchars($_POST['from_date']);
        $until_date = htmlspecialchars($_POST['until_date']);
        $full_name = htmlspecialchars($_POST['full_name']);
        $room_id = htmlspecialchars($_POST['room_name']);

        if(empty($from_date) && empty($until_date) && empty($full_name)){
            $msg = "Fields should not be empty";
            $msgClass = "red white-text";
        }else{
            $query = "INSERT INTO bookings(room_id, full_name, from_date, until_date) VALUES('{$room_id}', '{$full_name}', '{$from_date}', '{$until_date}')";
            $result = mysqli_query($connection, $query);

            if(!$result){
                die("QUERY FAILED " . mysqli_error($connection));
            }

            $msg = "Your room has been booked successfully!";
            $msgClass = "blue-grey white-text";
            }        
        
    }
?>

<div class="container">
    <h1 class="center-align">Book a room</h1>
    <form class="form" method="post">
    <!-- Message display -->
    <?php if($msg != '') : ?>
        <div class="<?= $msgClass; ?>"><h5 class="center-align"><?= $msg; ?></h5></div>
    <?php endif; ?>
        <div class="input-field">
            <input type="text" name="from_date" class="datepicker">
            <label for="date">From Date</label>
        </div>
        <div class="input-field">
            <input type="text" name="until_date" class="datepicker">
            <label for="date">Until Date</label>
        </div>
        <div class="input-field">
            <input type="text" id="name" name="full_name">
            <label class="active" for="name">Enter yout full Name</label>
        </div>
        <div class="input-field">
            <select name="room_name">

            <?php
            $query = "SELECT * FROM rooms";
            $result = mysqli_query($connection, $query);

            //   comfirm($result);

            while($row = mysqli_fetch_assoc($result)){
                $room_id = $row['room_id'];
                $room_name = $row['room_name'];

                echo "<option value='{$room_id}'>{$room_name}</option>";
            }
            ?>

            </select>
            <label>Choose a room</label>
        </div>
        <button class="btn waves-effect waves-light blue-grey" type="submit" name="submit">Book</button>
    </form>
</div>


 <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

 <script>
    $(document).ready(function(){
        $('.datepicker').datepicker({
            format : 'yyyy-mm-dd'
        });
    });

    $(document).ready(function(){
        $('select').formSelect();
    });

 </script>
</body>
</html>
