<?php
session_start();
// now unset them

unset($_SESSION['username']);
unset($_SESSION['rank']);

// and finally permanent destruction

session_destroy();
session_write_close();

// see you later!

header("Location: /");
?>
