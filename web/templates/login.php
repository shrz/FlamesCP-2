<body>

<div style="padding-top: 100px;"></div>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-center">
            <div class="well well-lg">

                <center>
                    <h1><b>Login to FlamesCP</b></h1>
                    <hr>

                    <?php

                    if ($_GET['err'] == "invalid") {
                        echo '<div class="alert alert-danger"><b>Invalid username and/or password.</b></div>';
                    }

                    if ($_GET['err'] == "missing") {
                        echo '<div class="alert alert-danger"><b>Missing username and/or password.</b></div>';
                    }

                    ?>

                    <form action="login.php" method="POST" id="loginform">
                        <input class="form-control input-lg" name="username" placeholder="Username..." style="margin-top: 20px; margin-right: auto; margin-bottom: 20px; margin-left: auto; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-radius: 7px;" type="text" required="required">
                        <input class="form-control input-lg" name="password" placeholder="Password..." style="margin-top: 20px; margin-right: auto; margin-bottom: 20px; margin-left: auto; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-radius: 7px;" type="password" required="required">
                        <br />
                        <input class="btn btn-success btn-lg btn-block" value="Log in" type="submit">

                        <script>

                            $('#loginform').submit(function()
                            {
                                $("input[type='submit']", this)
                                    .val("Please wait...")
                                    .attr('disabled', 'disabled');

                                return true;
                            });

                        </script>

                    </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>