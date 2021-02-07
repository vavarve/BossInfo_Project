<?php include("includes/header.php");?>
  
<?php include("includes/navbar.php");?>

<?php

    // if check so someone can't access admin page by typing the path in the URL
    if(isset($_SESSION['username'])):

        $msg = '';
        $msgClass = '';

        if(isset($_POST['submit'])):
        $room_name = htmlspecialchars($_POST['room_name']);

        if(empty($room_name)){
            $msg = "Room Name should not be empty";
            $msgClass = "red white-text";
        }else{
            $query = "INSERT INTO rooms(room_name) VALUE('{$room_name}')";
            $result = mysqli_query($connection, $query);

            if(!$result){
                die("QUERY FAILED " . mysqli_error($connection));
            }

            $msg = "Room Added Successfully!";
            $msgClass = "blue-grey white-text";
        }

        

    endif;
?>

<div class="container">
    <h1 class="center-align">Add a room</h1>
    <!-- Message display -->
    <?php if($msg != '') : ?>
        <div class="<?= $msgClass; ?>"><h5 class="center-align"><?= $msg; ?></h5></div>
    <?php endif; ?>
    <form class="form" method="post">
        <div class="input-field">
            <input type="text" id="name" name="room_name">
            <label class="active" for="name">Enter Room Name</label>
        </div>
        <button class="btn blue-grey" name="submit">Add</button>
    </form>
</div>


    <!--Import jQuery before materialize.js-->
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

 <script>
    // $(".button-collapse").sideNav();
 </script>
</body>
</html>

<?php  
    else :
        // if not logged in, redirect to login page
        header("Location:login.php");
    endif;
?>