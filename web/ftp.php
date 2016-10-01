<?php
require 'include/application.php';
include 'include/header-internal.php';

if ($_SESSION['username'] !== "admin") {
    $errorMessage = 'You do not have permission to manage FTP accounts.';
    require 'templates/access-denied.php';

    die();
}

$mydb = 'vsftpd';
$db = new PDO("mysql:host=$server;dbname=$mydb", $username, $password);
?>
<?php if ($_POST['act'] == "remove" && !empty($_POST['account'])) : ?>
    <?php
    $delquery = $db->prepare('delete from accounts where username=:userdel');
    $delquery->bindParam(':userdel', $_POST['account']);
    $delquery->execute();
    file_put_contents("/var/run/flamescp.sock", "systemcmd--------reloadftp\n", FILE_APPEND | LOCK_EX);
    ?>
    <div class="alert alert-danger">
        <b>The account '.$_POST['account'].' has been removed.</b>
    </div>
<?php endif; ?>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Account ID</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $accounts = $db->prepare('select * from accounts');
        $accounts->execute();
        ?>

        <?php if (!$accounts->rowCount() > 0) : ?>
            <tr>
                <td colspan="3">No records found</td>
            </tr>
        <?php endif; ?>

        <?php foreach ($accounts as $row) : ?>
            <tr>
                <td><?= $row["id"]; ?></td>
                <td><?= $row["username"]; ?></td>
                <td>
                    <form action="ftp.php" method="POST">
                        <input type="hidden" name="act" value="remove">
                        <input type="hidden" name="account" value="<?= $row["username"]; ?>">
                        <input class="btn btn-danger btn-block" value="Remove account" type="submit">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<br/>

<h3>Create account</h3>
<br/>
<?php if ($_POST['act'] == "create") : ?>
    <?php if (empty($_POST['username']) || empty($_POST['password'])) : ?>
        <div class="alert alert-info">
            <b>Seems like you missed something.</b>
        </div>
    <?php else : ?>
        <?php
        $check = $db->prepare('select * from accounts where username=:account');
        $check->bindParam(':account', $_POST['username']);
        $check->execute();
        ?>

        <?php if ($check->rowCount() > 0) : ?>
            <div class="alert alert-danger">
                <b>The username has already been taken.<b/>
            </div>
        <?php else : ?>
            <?php
            $create = $db->prepare('insert into accounts (username, pass) VAlUES (:username, :password);');
            $create->bindParam(':username', $_POST['username']);
            $create->bindParam(':password', md5($_POST['password']));
            $create->execute();
            file_put_contents("/var/run/flamescp.sock", "systemcmd--------reloadftp\n", FILE_APPEND | LOCK_EX);
            ?>

            <div class="alert alert-success">
                Account created. Click <a href="ftp.php">here</a> to reload the page.
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<form action="ftp.php" method="POST">
    <input name="act" type="hidden" value="create">
    <input class="form-control" name="username" placeholder="The account's username...">
    <br/>
    <input class="form-control" name="password" placeholder="The account's password..." type="password">
    <br/>
    <input class="btn btn-success btn-block" type="submit" value="Create account">
</form>
<?php
require 'include/footer.php';
