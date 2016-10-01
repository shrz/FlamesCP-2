<?php
$logged_in_check = false;
require 'include/application.php';

if ($logged_in !== true) {
    require 'include/header.php';
    require 'templates/login.php';
    die();
}
require 'include/header-internal.php';
?>

<div id="msgarea"></div>
<div class="btn-group">
    <button class="btn btn-success" id="startserver">Start server</button>
    <button class="btn btn-danger" id="stopserver">Stop server</button>
    <a href="accounts.php" class="btn btn-info">Account manager</a>
    <a href="ftp.php" class="btn btn-primary">FTP manager</a>
    <a href="password.php" class="btn btn-warning">Change your password</a>
    <a href="logout.php" class="btn btn-default">Log out</a>
</div>
<br/>
<br/>

<p>Console</p>

<div style="border-radius: 10px; width: 100%; overflow: hidden;">
    <iframe src="console_output.php" scrolling="vertical" width="100%" height="400px" style="border:1px solid lightgrey;">Your browser is not supported.
    </iframe>
</div>
<br/>
<br/>

<form action="cmd.php" method="POST" id="cmdform">
    <div class="input-group">
        <input class="form-control" name="cmd" placeholder="Console command...">
        <span class="input-group-btn">
            <input class="btn btn-success" value="Send" type="submit">
        </span>
    </div>
</form>
<?php
require 'include/footer.php';
