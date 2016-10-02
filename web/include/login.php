<?php
session_start();

require 'include/db.php';

if (!empty($_SESSION['username'])) {
  $user_query = $conn->prepare('select id from login where username=:username');
  $user_query->bindParam(':username', $_SESSION['username']);
  $user_query->execute();
  
  if (!$user_query->rowCount() > 0){

    // the user set in the session is not valid
    // log out now

    header('Location: /logout.php');
    die('');
  
  }  
  
}
?>
