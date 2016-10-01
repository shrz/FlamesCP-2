<?php
#log errors

include __DIR__ . '/config.php';

$server = 'localhost';
$username = 'root';
$password = $mysql_password;
$database = 'flamescp';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
