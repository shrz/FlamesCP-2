<?php
include 'include/login.php';
if ($logged_in == "false"){
header("Location: /");
die();
}

session_start();
include 'include/header.php';
?>

<body>
<br />
<br />
<div class="container">
<div class="jumbotron">
<h2><b>FlamesCP 2 - Change your password</b><span style="font-size: 12px">&nbsp;&nbsp;<a href="/">Return to dashboard</a></span></h2>
<br />
<br />
<?php
if (!empty($_POST['newpassword'])){

$password = $_POST['newpassword'];

$query = $conn->prepare('update login set password=:password where username=:username');

$query->bindParam(':password', crypt($_POST['password']), $salt);
$query->bindParam(':username', $_SESSION['username']);

$query->execute();

?>

<div class="alert alert-success">Your new password has been saved. Click <a href="/">here</a> to go back.</div>

<br />

<form action="password.php" method="POST" id="passwordform">
<label>New password</label>
<input class="form-control" name="newpassword" placeholder="Your new password..." disabled="disabled">
<br />
<br />
<input class="btn btn-success btn-block" value="Success" type="submit" disabled="disabled">
</form>

<?php

} else {
?>

<form action="password.php" method="POST" id="passwordform">
<label>New password</label>
<input class="form-control" name="newpassword" placeholder="Your new password..." type="password">
<br />
<br />
<input class="btn btn-success btn-block" value="Change password" type="submit">
</form>

<?php
}
?>

</body>
</html>
