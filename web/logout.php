<?php
session_start();

// make sure the session variables have been emptied

$_SESSION['username'] = "";
$_SESSION['rank'] = "";

// now unset them

unset($_SESSION['username']);
unset($_SESSION['rank']);

// and finally permanent destruction

session_destroy();
session_write_close();

// see you later!

header("Location: /");
?>
