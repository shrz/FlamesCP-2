<?php
include 'include/application.php';

$processes = shell_exec('ps aux');

if (strpos($processes, 'java') !== false) : ?>
    <div class="alert alert-danger">
        <b>The server is already running.</b>
    </div>
<?php else : ?>
    <?php
    file_put_contents("/var/run/flamescp.sock", "systemcmd--------start\n", FILE_APPEND | LOCK_EX);
    ?>
    <div class="alert alert-success">
        <b>The server was started.</b>
    </div>
<?php endif; ?>
