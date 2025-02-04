<?php
define('TITLE', "Login");
include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/header.php";
check_logged_out();
?>

<script src="/assets/vendor/alerty/js/alerty.min.js"></script>
<link rel="stylesheet" type="text/css" href="/assets/vendor/alerty/css/alerty.min.css">
<?php
if (!check_session()) {
	$user1 = $_SESSION['username'];
	echo ('<script> alerty.toasts(\'We could not verify your session, please enter password\'); </script>');
}
?>
<div class="container" >
    <div class="row">
        <div class="col-sm-4">

        </div>
        <div class="col-sm-4">
            <form class="form-auth" action="includes/login.inc.php" method="post">

                <?php insert_csrf_token(); ?>

                <div class="text-center">
                    <img class="mb-1" src="/assets/images/logo.png" alt="" width="130" height="130">
                </div>

                <h6 class="h3 mb-3 font-weight-normal text-muted text-center">Login to your Account</h6>

                <div class="text-center mb-3">
                    <small class="text-success font-weight-bold">
                        <?php
                            if (isset($_SESSION['STATUS']['loginstatus']))
                                echo $_SESSION['STATUS']['loginstatus'];

                        ?>
                    </small>
                </div>

                <div class="form-group">
                    <label for="username" class="sr-only">Username</label>
                    	<input type="text" id="username" name="username" class="form-control" placeholder="Username" required  <?php if(!check_session()) echo "disabled value=$user1"; else echo "autofocus";?>>
                    <?php 
                    	if (!check_session())
                    		echo("<input type=\"hidden\" name=\"username\" class=\"form-control\" value=$user1 required>"); 
                    ?>
                    <!input type="text" id="username" name="username" class="form-control" placeholder="Username" value="" required autofocus>
                    <sub class="text-danger">
                        <?php
                            if (isset($_SESSION['ERRORS']['nouser']))
                                echo $_SESSION['ERRORS']['nouser'];
                        ?>
                    </sub>
                </div>

                <div class="form-group">
                    <label for="password" class="sr-only">Password</label>
         			<input type="password" id="password" name="password" class="form-control" placeholder="Password" required  <?php if(!check_session()) echo "autofocus"; ?>>
                    <!input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                    <sub class="text-danger">
                        <?php
                            if (!check_session()) {
                            	if (!isset($_SESSION['ERRORS']['wrongpassword'])) {
                            	      echo "Please login again";
                            	}
                             }
                             if (isset($_SESSION['ERRORS']['wrongpassword']))
                          	      echo $_SESSION['ERRORS']['wrongpassword'];
                        ?>
                    </sub>
                </div>
<?php if(check_session()) { ?>
                <div class="col-auto my-1 mb-4">
                    <div class="custom-control custom-checkbox mr-sm-2">
		    	<input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme">
                        <label class="custom-control-label" for="rememberme">Remember me</label>
                    </div>
                </div>
<?php } ?>

                <button class="btn btn-lg btn-primary btn-block" type="submit" value="loginsubmit" name="loginsubmit">Login</button>

                <p class="mt-3 text-muted text-center"><a href="/reset-password/">forgot password?</a></p>

                <p class="mt-4 mb-3 text-muted text-center">
                    <a href="https://github.com/msaad1999/PHP-Login-System" target="_blank">
                        Login System
                    </a> | 
                    <a href="https://github.com/msaad1999/PHP-Login-System/blob/master/LICENSE" target="_blank">
                        MIT License
                    </a>
                </p>

            </form>
        </div>
        <div class="col-sm-4">

        </div>
    </div>
</div>


<?php

include "{$_SERVER['DOCUMENT_ROOT']}/assets/layouts/footer.php";

?>


<noscript> <meta http-equiv = "refresh" content = "0; url = <?php if($_SERVER['HTTPS']) { echo ("https://"); } else { echo ("http://");} echo ($_SERVER['HTTP_HOST']); echo ("/redirect.php?type=error_js&return=/login"); ?>"> </noscript>
