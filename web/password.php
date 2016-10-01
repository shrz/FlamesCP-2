<?php
include 'include/application.php';

include 'include/header-internal.php';
?>
<?php if (!empty($_POST['newpassword'])) : ?>
    <?php
    $password = $_POST['newpassword'];
    $query = $conn->prepare('update login set password=:password where username=:username');
    $query->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT, $bcrypt_opt));
    $query->bindParam(':username', $_SESSION['username']);
    $query->execute();
    ?>

    <div class="alert alert-success">Your new password has been saved. Click <a href="/">here</a> to go back.
    </div>

    <br/>

<?php endif; ?>

<form action="password.php" method="POST" id="passwordform">
    <label>New password</label>
    <input class="form-control" name="newpassword" placeholder="Your new password..." type="password" <?= (!empty($_POST['newpassword'])) ? 'disabled="true"':''; ?>>
    <br/>
    <br/>
    <input class="btn btn-success btn-block" value="Change password" type="submit">
</form>
<?php
require 'include/footer.php';
