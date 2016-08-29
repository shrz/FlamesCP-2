<?php
#log errors

include 'include/config.php';

        $server = 'localhost';
        $username = 'root';
        $password = $mysql_password;
        $database = 'flamescp';

try{
        $conn = new PDO("mysql:host=$server;dbname=$database", $username, $password);

}catch(PDOException $e){
        die("Connection failed: " . $e->getMessage());
}

?>
