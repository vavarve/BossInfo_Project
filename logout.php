<?php session_start(); ?>

<?php

  $_SESSION['id'] = null;
  $_SESSION['username'] = null;

  session_destroy();
  header("Location: index.php");
  
?>