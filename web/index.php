<?php
require 'include/header.php';
require 'include/login.php';

if ($logged_in == "true"){
?>

<body>
<br />
<br />
<div class="container">
<div class="jumbotron">
<h2><b>FlamesCP 2 - Minecraft Control Panel</b></h2>
<br />
<div id="msgarea"></div>
<div class="btn-group">
<button class="btn btn-success" id="startserver">Start server</button>
<button class="btn btn-danger" id="stopserver">Stop server</button>
<a href="accounts.php" class="btn btn-info">Account manager</a>
<a href="password.php" class="btn btn-warning">Change your password</a>
<a href="logout.php" class="btn btn-default">Log out</a>
</div>
<br />
<br />
<p>Console</p>
<div style="border-radius: 10px; width: 100%; overflow: hidden;">  
<iframe src="console_output.php" scrolling="vertical" width="100%" height="400px" style="border:1px solid lightgrey;">Your browser is not supported.</iframe>
</div>
<br />
<br />
<form action="cmd.php" method="POST" id="cmdform">
<div class="input-group">
<input class="form-control" name="cmd" placeholder="Console command...">
<span class="input-group-btn">
<input class="btn btn-success" value="Send" type="submit">
</span>
</div>
</form>
</div>
</div>
</body>
</html>

<?php
} else {
?>

<body>

<div style="padding-top: 100px;"></div>

<div class="container">
<div class="row">
<div class="col-md-4 col-center">
<div class="well well-lg">

<center>
<h1><b>Login to FlamesCP</b></h1>
<hr>

<?php

if ($_GET['err'] == "invalid") {
echo '<div class="alert alert-danger"><b>Invalid username and/or password.</b></div>';
} 

if ($_GET['err'] == "missing") {
echo '<div class="alert alert-danger"><b>Missing username and/or password.</b></div>';
}

?>

<form action="login.php" method="POST">
<input class="form-control input-lg" name="username" placeholder="Username..." style="margin-top: 20px; margin-right: auto; margin-bottom: 20px; margin-left: auto; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-radius: 7px;" type="text" required="required">
<input class="form-control input-lg" name="password" placeholder="Password..." style="margin-top: 20px; margin-right: auto; margin-bottom: 20px; margin-left: auto; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-radius: 7px;" type="password" required="required">
<br />
<input class="btn btn-success btn-lg btn-block" value="Log in" type="submit">
</form>
</div>
</div>
</div>
</div>

</body>
</html>

<?php
}
?>
