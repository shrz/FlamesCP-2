<?php
require 'include/db.php';
require 'include/header.php';
?>

<body>
<br/>
<br/>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-center">
            <div class="jumbotron">
                <h2 style="text-align: center"><b>Welcome</b></h2>
                <?php
                if (!empty($_POST['password'])) {
                    $password = crypt($_POST['password'], $salt);
                    $query = $conn->prepare('insert into login (username, password, status) VAlUES (:username, :password, "admin");');
                    $query->bindParam(':username', 'admin');
                    $query->bindParam(':password', password_hash($_POST['password'], PASSWORD_BCRYPT, $bcrypt_opt));

                    if ($query->execute()) {
                        //destroy installer since installation was successful
                        $msg = 'success';
                    } else {
                        $msg = 'fail';
                    }
                }
                ?>
                <p style="text-align: center">Please set your password.</p>
                <?php if ($msg == "success") : ?>
                    <br />
                    <div class="alert alert-success">
                        <b>Congratulations!</b> FlamesCP 2 has been successfully installed. Click <a href="index.php">here</a> to log in.
                    </div>
                    <?php unlink('installer.php'); ?>
                <?php else : ?>
                    <?php if ($msg == "fail") : ?>
                        <br />
                        <div class="alert alert-success">
                            <b>Error:</b> The creation of the administrative user has failed. Please contact support.
                        </div>
                    <?php else : ?>
                        <form action="installer.php" method="POST">
                            <label>User</label>
                            <input class="form-control" value="admin">
                            <label>Password</label>
                            <input class="form-control" placeholder="Password..." type="password" name="password">
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
