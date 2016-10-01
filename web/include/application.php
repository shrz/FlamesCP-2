<?php

session_start();

require 'db.php';

$logged_in = isset($_SESSION['username']);

// Check if the user is logged in
if ($logged_in === false && (isset($logged_in_check) && $logged_in_check === true)) {
    header("Location: /");
    die();
}
