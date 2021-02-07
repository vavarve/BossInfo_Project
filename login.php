<?php include("includes/header.php");?>
  
<?php include("includes/navbar.php");?>

<?php
    // Message Vars 
    $msg = '';
    $msgClass = '';

 if(isset($_POST['submit'])):
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if(empty($username) || empty($password)){
        $msg = "Username or password fields should not be empty!";
        $msgClass = "red white-text";
    }else{
        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $result = mysqli_query($connection, $query);
        if(!$result){
            die("QUERY FAILED " . mysqli_error($connection));
        }

        while($row = mysqli_fetch_array($result)):
            $db_user_id = $row['id'];
            $db_username = $row['username'];
            $db_password = $row['password'];

            if($username !== $db_username || $password !== $db_password){
                // header("Location:login.php");
                $msg = "Incorrect username or password! Please try again!";
                $msgClass = "red white-text";
            }else if($username == $db_username && $password == $db_password){
                $_SESSION['id'] = $db_user_id;
                $_SESSION['username'] = $db_username;
    
                header("Location:admin.php");
            }else{
                header("Location:login.php");
            }
        endwhile;

    }   
    
endif;
?>

<div class="container margin">
    <div class="row">
        <h1 class="center-align"><i class="large material-icons">account_circle</i>Login</h1>
    </div>
    <div class="row">
        <div class="col s6 offset-s3">
        <?php if($msg != '') : ?>
            <div class="<?= $msgClass; ?>"><h5 class="center-align"><?= $msg; ?></h5></div>
        <?php endif; ?>
            <form method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
                <div class="input-field">
                    <input type="text" id="username" name="username">
                    <label class="active" for="username">Username</label>
                </div>
                <div class="input-field">
                    <input type="password" id="password" class="validate" name="password">
                    <label class="active" for="password">Password</label>
                </div>
                <button class="btn waves-effect waves-light blue-grey" name="submit">Login</button>
            </form>
        </div>
    </div>
</div>