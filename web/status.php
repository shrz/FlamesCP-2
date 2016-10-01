<?php
include 'include/login.php';
if ($logged_in == "false"){
header("Location: /");
die();
}

$processes = shell_exec('ps aux');

if (strpos($processes, 'java') !== false && strpos($processes, 'server.jar')) {
echo "running";
} else {
echo "off";
}

?>
