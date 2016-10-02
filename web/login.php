<?php
session_start();

include 'include/db.php';

if (!empty($_POST['username']) && !empty($_POST['password'])){

  $username = $_POST['username'];
  $password = $_POST['password'];

  $check = $conn->prepare('select * from login where username=:username');
  $check->bindParam(":username", $username);

  $check->execute();
  $results = $check->fetch();

  if (!$check->rowCount() > 0) {
    header("Location: /?err=invalid");
    die();
  }
  if(!password_verify($password, $results['password'])) {
    header("Location: /?err=invalid");
    die();
  }

$_SESSION['username'] = $username;

$_SESSION['rank'] = $results['status'];

header("Location: /");

} else {

header("Location: /?err=missing");

}

?>
