<?php
include 'include/db.php';

if (!empty($_POST['username']) && !empty($_POST['password'])){

$username = $_POST['username'];
$password = $_POST['password'];
$encrypted_password = crypt($password, $salt);

$check = $conn->prepare('select * from login where username=:username and password=:password');
$check->bindParam(":username", $username);
$check->bindParam(":password", $encrypted_password);

$check->execute();
$results = $check->fetch();

if (!$check->rowCount() > 0) {
header("Location: /?err=invalid");
die();
}

session_start();

$_SESSION['username'] = $username;

$_SESSION['rank'] = $results['status'];

header("Location: /");

} else {

header("Location: /?err=missing");

}

?>
