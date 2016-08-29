<?php
include 'include/login.php';
if ($logged_in == "false"){
header("Location: /");
die();
}

$processes = shell_exec('ps aux');

if (strpos($processes, 'java') !== false) {
file_put_contents("/var/run/flamescp.sock", "stop\n", FILE_APPEND | LOCK_EX);
echo '<div class="alert alert-success"><b>The server has been stopped.</b></div>';
} else {
echo '<div class="alert alert-danger"><b>The server is already off.</b></div>';
}

?>
