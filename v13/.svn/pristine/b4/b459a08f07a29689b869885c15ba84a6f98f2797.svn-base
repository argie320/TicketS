<?php 
include('steadFast.class.php');



if(isset($_POST['user_name'])){
	/*
	$un = $_POST['user_name'];
	$pass = $_POST['pass_word'];
	$email = $_POST['email'];
	$fn = $_POST['fullname'];
	$phone = $_POST['phone'];
	$mobile = $_POST['mobile'];
	$position = $_POST['position'];
	$company = $_POST['company'];
	$type = $_POST['type'];
	
	$app = new steadFast();
	$app->register( $un, $pass, $email, $fn, $phone, $mobile, $position, $company, $type, 0);
	*/
	
}



 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register</title>

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<!--<script type="text/javascript" src="js/checker.js"></script>-->
<style type="text/css">
	.ajaxloader{
		display:none;
	}
	span{
		display:none;
		color:red;
	}
</style>


</head>

<body>

	<form method="POST" action="register.php">
    
		<input type="text" name="user_name" placeholder="username"  id="un" required pattern="^[A-Za-z0-9\.\'\-]{2,15}$" title="Username Pattern" /><span>Username validation</span><img class="ajaxloader" src="images/ajax-loader.GIF" width="20" height="24" />
        <br />
		<input type="text" name="pass_word" placeholder="password"  required />
		<br />
        <input type="email" name="email" placeholder="email"  required  pattern="^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" title="fallow email pattern"  />
        <br />
		<input type="text" name="fullname" placeholder="fullname" required />
		<br />
        <input type="text" name="phone" placeholder="phone"  />
		<br />
        <input type="text" name="mobile" placeholder="mobile 09xxxxxxxxx"   pattern="^[090-9]{11}" title="fallow mobile number pattern" />
		<br />
        <select name="position" required >
        	<option value="Supervisor">Supervisor</option>
            <option value="CSR">CSR</option>
            <option value="Enginner">Enginner</option>
        </select>
		<br />
        <!--<input type="text" name="company" placeholder="company" required />-->
        <br />
        <select name="company" required >
        	<option value="Stead Fast Solutions Inc.">Stead Fast Solutions Inc.</option>
            <option value="Jump Solutions Inc.">Jump Solutions Inc.</option>
            <option value="Forefront Innovative Technologies Inc.">Forefront Innovative Technologies</option>
        </select>
        <br />
		<!--<input type="text" name="type" placeholder="admin?"  required />-->
        <p>Admin:</p>
        <select name="type" required >
        	<option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
		<br />
		<input type="submit" value="submit"  />
        <br />
	</form>

</body>
</html>