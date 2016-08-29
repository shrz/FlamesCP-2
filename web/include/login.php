<?php
session_start();

if (isset($_SESSION['username'])){
$logged_in = 'true';
} else {
$logged_in = 'false';
}
?>
