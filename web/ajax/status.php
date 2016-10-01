<?php
include 'include/application.php';

$processes = shell_exec('ps aux');

echo (strpos($processes, 'java') !== false) ? "running":"off";
