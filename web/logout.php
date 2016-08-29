<?php
session_start();
$_SESSION['username'] = "";
$_SESSION['rank'] = "";
unset($_SESSION['username']);
unset($_SESSION['rank']);
session_write_close();
header("Location: /");
?>
