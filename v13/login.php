<?php

include "init.php";


if(loggedIn()){
    header("Location: myticket.php");
    exit();
}

function accessGranted($username, $location){

    if(isset($username)){
        $_SESSION['username']=$username;
        Redirect::to( 5 , ' '.$location.'? ');
    }else{
        Redirect::to( 0 , null);
    }

}

$error = "";

if (isset($_POST['submit'])) { 
	
	$username = $_POST['UzR'];
	$password = $_POST['pzwrd'];

	//$rememberme = $_POST['rememberme'];
	
	if($username&&$password){

        $app = new SteadFast();
        $loginResult  = $app->login($username, $password, 0);
        echo $loginResult;

        if(is_numeric($loginResult)){

            switch($loginResult){
                case -1:
                    $error = 'Invalid username or password.';
                    break;
                case 0:
                    accessGranted($username, "myticket");
                    break;
                case 1:
                    accessGranted($username, "myassignticket");
                    break;
                case 2:
                    accessGranted($username, "myworkorder");
                    break;
                case 3:
                    accessGranted($username, "myadmin");
                    break;
                default:
                    Redirect::to( 0 , null);
                    break;

            }
        }else{
            $error = "Unexpected Error Return type !";
        }


			/*
			 * Cookies
			/*
			if($rememberme=="on")
				setcookie("username",$username, time()+7200 );

			else if($rememberme=="")*/





	}else{
        $error = "Please enter a username and password.";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="7200" />
	<meta name="robots" content="noindex" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0 ">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
			var inputs = ["text","password"];
            for(var i = 0; i < inputs.length; i++){
				$("input[type="+inputs[i]+"]").val('');
				console.log();
			}
        });
    </script>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="js/bootstrap.js"></script>



</head>
<body>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="container">

<div class="row">
<div class="col-sm-6 col-md-6 col-md-offset-3">
			
            <div class="account-wall" style="border-radius: 10px; background-color: #ffffff;">
            
            <img class="img-responsive" src="images/logo.jpg" alt="">
            <form class="form-signin" action="login.php" method="post">
                <input type="text" name="UzR" class="form-control" id="username" placeholder="Username" required autofocus>
                <input type="password" name="pzwrd" class="form-control" id="password" placeholder="Password" required>
                <input type="submit" class="btn btn-lg btn-primary btn-block" id="login" name="submit" value="Login">
                    </input>
                <label class="checkbox pull-right">
                    <input type="checkbox" value="rememberme" name="rememberme">Remember me</label>
                    <br/>
                    <br/>
                    <div class="alert alert-warning center" style="max-width: 556px;" id="alert">
       <?php echo $error?>
    </div>                    
                <span class="clearfix"></span>
            </form>
        </div>
        <br/>
<p style="margin:auto; text-align:center; width:100%;"><a href="http://www.atomitsoln.com" class="" target="_blank">AtomIT Solutions</a> &copy; All rights reserved 2014.mpz</p>
    </div>
</div>
</div>
</body>
</html>