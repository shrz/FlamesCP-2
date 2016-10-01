<?php
require 'include/application.php';

include 'include/header-internal.php';

if ($_SESSION['username'] !== "admin") {
    $errorMessage = 'You do not have permission to manage accounts.';
    require 'templates/access-denied.php';

    die();
}

if ($_POST['act'] == "remove" && !empty($_POST['account'])) : ?>

    <?php if ($_POST['account'] == "admin") : ?>
        <div class="alert alert-info">
            <b>This account is protected.</b>
        </div>
    <?php else : ?>
        <?php
        $delquery = $conn->prepare('delete from login where username=:userdel');
        $delquery->bindParam(':userdel', $_POST['account']);
        $delquery->execute();
        ?>

        <div class="alert alert-danger">
            <b>The account <?= $_POST['account']; ?> has been removed.</b>
        </div>
    <?php endif; ?>

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
        $logins = $conn->prepare('select * from login');
        $logins->execute();
        ?>

        <?php foreach ($logins as $login) : ?>
            <tr>
                <td><?= $login["id"]; ?></td>
                <td><?= $login["username"]; ?></td>
                <td>
                <?php if ($login['id'] == "1") : ?>
                    N/A
                <?php else : ?>
                    <form action="accounts.php" method="POST">
                        <input type="hidden" name="act" value="remove">
                        <input type="hidden" name="account" value="<?= $login["username"]; ?>">
                        <input class="btn btn-danger btn-block" value="Remove account" type="submit">
                    </form>
                <?php endif; ?>
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
        $check = $conn->prepare('select * from login where username=:account');
        $check->bindParam(':account', $_POST['username']);
        $check->execute();
        ?>

        <?php if ($check->rowCount() > 0) : ?>
            <div class="alert alert-danger">
                <b>The username has already been taken.<b/>
            </div>
        <?php else : ?>
            <?php
            $create = $conn->prepare('insert into login (username, password, status) VAlUES (:username, :password, "admin");');
            $create->bindParam(':username', $_POST['username']);
            $create->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT, $bcrypt_opt));
            $test = $create->execute();
            ?>

            <div class="alert alert-success">
                Account created. Click <a href="accounts.php">here</a> to reload the page.
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<form action="accounts.php" method="POST">
    <input name="act" type="hidden" value="create">
    <input class="form-control" name="username" placeholder="The account's username...">
    <br/>
    <input class="form-control" name="password" placeholder="The account's password..." type="password">
    <br/>
    <input class="btn btn-success btn-block" type="submit" value="Create account">
</form>
<?php
require 'include/footer.php';
