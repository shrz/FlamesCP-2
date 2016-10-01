<?php
include 'include/login.php';
if ($logged_in == "false"){
header("Location: /");
die();
}

$processes = shell_exec('ps aux');

if (strpos($processes, 'java') !== false) {
echo '<div class="alert alert-danger"><b>The server is already running.</b></div>';
} else {
file_put_contents("/var/run/flamescp.sock", "systemcmd--------start\n", FILE_APPEND | LOCK_EX);
echo '<div class="alert alert-success"><b>The server was started.</b></div>';
}

?>
