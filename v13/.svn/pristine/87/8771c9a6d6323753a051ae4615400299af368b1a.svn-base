<?php
include("init.php");
//check username
if(isset($_POST['usernamecheck'])){

	$username = preg_replace('#[^a-z0-9]#i', '' , stripslashes( strip_tags( $_POST['usernamecheck'] )));

	$app = new steadFast();
	$un_check = $app->checkUsernameIfExits($username);

	if (strlen($username) < 3 || strlen($username) > 16) {
	    echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
	    exit();
    }
    if ($un_check == 1) {
	    echo '<strong style="color:#009900;">' . $username . ' is OK</strong>';
	    exit();
    }if ($un_check == 0){
	    echo '<strong style="color:#F00;">' . $username . ' is taken</strong>';
	    exit();
    }

}

if(isset($_POST['emailcheck'])){

	$email = stripslashes( strip_tags( trim( $_POST['emailcheck']  )));

	$app = new steadFast();
	$email_check = $app->checkEmailIfExits($email);

    if ($email_check == 1) {
	    echo '<strong style="color:#009900;">' . $email . ' is OK</strong>';
	    exit();
    }if ($email_check == 0){
	    echo '<strong style="color:#F00;">' . $email . ' is taken</strong>';
	    exit();
    }

}


if(isset($_POST['email'])){

	//echo "Processing your request";

	$emailRegex = '#^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$#';

	$un = preg_replace('#[^a-z0-9]#i', '' , stripslashes( strip_tags( trim(  $_POST['user_name'] ) )));
	$pass = stripslashes( strip_tags( $_POST['pass_word'] ));
	/*not working $email = preg_replace($emailRegex, '', stripslashes( strip_tags( trim( $_POST['email'] ))));*/
	$email = stripslashes( strip_tags( trim( $_POST['email'] )));
	$fn = preg_replace('#[^a-zA-Z0-9\.\'\-\ ]#i', '' , stripslashes( strip_tags( trim(  $_POST['fullname'] ) )));
	$phone = preg_replace('#^[0-9]{7,10}#', '' , stripslashes( strip_tags( trim(  $_POST['phone'] ) )));
	$mobile = preg_replace('#^[0-9]{11}#', '' , stripslashes( strip_tags( trim(  $_POST['mobile'] ) )));
	$position = preg_replace('#^[a-zA-Z -.]#','', stripslashes( strip_tags( trim(  $_POST['position'] )) ));
	$company = stripslashes( strip_tags( trim(  $_POST['company'] ) ));
	$type = stripslashes( strip_tags( trim(  $_POST['type'] ) ));

   //	echo "$un, $pass, $email, $fn, $phone, $mobile, $position, $company, $type";

   // exit();

	$app = new steadFast();

	$un_check = $app->checkUsernameIfExits($un);
	$email_check = $app->checkEmailIfExits($email);

	if($un == "" || $pass == "" || $email == "" || $fn == "" || $company == "" || $position == ""){
		echo "The form submission is missing values.";
        exit();
	} else if ($un_check == 0){
        echo "The username you entered is alreay taken";
        exit();
	} else if ($email_check == 0){
        echo "That email address is already in use in the system";
        exit();
	} else if (strlen($un) < 3 || strlen($un) > 16) {
        echo "Username must be between 3 and 16 characters";
        exit();
    } else if (is_numeric($un[0])) {
        echo 'Username cannot begin with a number';
        exit();
    } else {


     $reg = $app->register( $un, $pass, $email, $fn, $phone, $mobile, $position, $company, $type, 0);
		if($reg){
			echo ''.$un.' is Registered';
		}else{
			echo 'You could not be registered due to a system error. We apologize for any inconvenience.';
		}
		exit();

    }
	//echo "$un, $pass, $email, $fn, $phone, $mobile, $position, $company, $type";
   	exit();

	/* GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	*/



}


?>

<!doctype html>
<html>
<head>

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>

<script type="text/javascript">

function _(x){
	return document.getElementById(x);
}
function ajaxObj(meth, url){
	var x = new XMLHttpRequest();
	x.open(meth, 	url, 		true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){
	if(x.readyState == 4 && x.status == 200){
		return true;
	}
}

</script>


<script type="text/javascript">
	$(document).ready(function(){

		$('#username').blur(function(){
			checkusername();
		});
		$('#email').blur(function(){
			checkemail();
		});

		$('#position').change(function(){

			if($(this).select == 0 || $(this).val() == 'Select Position'){
				console.log('invalid selection');
			}else{
				console.log($(this).val());
			}

		});

		$('#company').change(function(){

			if($(this).select == 0 || $(this).val() == 'Select Company'){
				console.log('invalid selection');
			}else{
				console.log($(this).val());
			}

		});

		function checkusername(){
			var u = $("#username").val();
			if(u != ""){
				$("#unamestatus").html('checking ...');
				var ajax = ajaxObj("POST", "createuser.php");
        		ajax.onreadystatechange = function() {
	        		if(ajaxReturn(ajax) == true) {
	            		$("#unamestatus").html(ajax.responseText);
	        		}
        		}
        	ajax.send("usernamecheck="+u);
			}
		}

		function checkemail(){
			console.log('checking');
			var email = $("#email").val();
			if(email != ""){
				$("#emailstatus").html('checking ...');
				var ajax = ajaxObj("POST", "createuser.php");
        		ajax.onreadystatechange = function() {
	        		if(ajaxReturn(ajax) == true) {
	            		$("#emailstatus").html(ajax.responseText);
	        		}
        		}
        	ajax.send("emailcheck="+email);
			}
		}

		var inputs  = ["#username","#password","#cfpassword","#email","#fullname","#phonenumber","#mobilenumber","#position","#company"];

		$('#create').click(function(){

			var status = $('#Regstatus');

			//checkpassword
			if($(inputs[2]).val() != $(inputs[1]).val()){
				status.text("Your password fields do not match");
				console.log($(inputs[2]).val());
				console.log($(inputs[1]).val());
			} else{
				console.log("OK");

				var ajax = ajaxObj("POST", "createuser.php");
				ajax.onreadystatechange = function() {
	        		if(ajaxReturn(ajax) == true) {
						console.log(ajax.responseText);
	            		status.text(ajax.responseText);


                    for(var i = 0; i < inputs.length; i ++){
				    $(inputs[i]).val("");
		                	}

                    }
        		}
			 	console.log("sending");
				ajax.send("email="+$(inputs[3]).val()+"&user_name="+$(inputs[0]).val()+"&pass_word="+$(inputs[1]).val()+"&fullname="+$(inputs[4]).val()+"&phone="+$(inputs[5]).val()+"&mobile="+$(inputs[6]).val()+"&position="+$(inputs[7]).val()+"&company="+$(inputs[8]).val()+"&type=0");

			}


		});

		$('#reset').click(function(){

			for(var i = 0; i < inputs.length; i ++){
				$(inputs[i]).val("");
			}

		});

	});
</script>




<meta charset="utf-8">
<title>Create User</title>
<link rel="stylesheet" type="text/css"  href="css/createuser.css" />
<link rel="stylesheet" type="text/css" href="css/menu2.css" />

</head>

<body>


<div id="container">
	<div id="body">

     <div id="header">

   <div id="logout">Welcome, <a href="adminChangePass.php" style="color:#06F;text-transform:capitalize"><?php echo $_SESSION['username']; ?></a> | <a href="logout.php"><font color="orange">Logout</font></a></div>


</div>

   		<div id="content">
        	<!-- START OF NAVBAR -->
          <!--	<div id="navbar">  -->
             	<div class="cssmenu">

   					<a href='myadmin.php'><span>Tickets</span></a>
                    <a href='myadminWorkOrder.php'><span>WorkOrders</span></a>
                    <a href='managestaff.php'><span>Manage Staff</span></a>
                    <a href='createuser.php'class='current'><span>Create User</span></a>

                 </div>
                 <div class="cssmenusub">
            <!-- END OF NAVBAR --->

            <p id="label2" style="margin-top:25px;">Create Account</p>
            <div style="width:550px; margin:auto;">


            	<form name="signupform" id="signupform" onsubmit="return false;" >


                <center><table id="table3">
                <tr>
                    	<td>
                        	<!--<input type="text" id="input" placeholder="ID Number" readonly name="num" value= "">-->
                        </td>
                    </tr>
                	<tr>
                    	<td><span id="status"></span>
                        	<input type="text" id="username"  placeholder="Username" required>
                            <span id="unamestatus"></span>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<input type="password" id="password" placeholder="Password"  required>
                        </td>
                    </tr>
                     <tr>
                    	<td>
                        	<input type="password" id="cfpassword"  placeholder="Confirm Password"  required>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<input type="text" id="email"  placeholder="Email Address" required  pattern="^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$" title="fallow email pattern"  />
                            <span id="emailstatus"></span>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<input type="text" id="fullname" placeholder="Full Name"  required>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                            <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="phonenumber"  placeholder="Phone Number"/>
                            <!--
                        	<input type="text" id="phonenumber"  placeholder="Phone Number"pattern="^[0-9]{7,10}" title="fallow phone number pattern" required/>
                        	-->
                        </td>
                    </tr>
                    <tr>
                    	<td>
                            <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="mobilenumber"  placeholder="Mobile Number" required />
                            <!--
                        	<input type="text" id="mobilenumber"  placeholder="mobile 09xxxxxxxxx" pattern="^[090-9]{11}" title="fallow mobile number pattern" required/>
                        	-->
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<select  id="position" style="margin-left:128px;"  >
                            	<option disabled selected>Select Position</option>
                                <option value="0">Customer Service Representative</option>
                                <option value="1">Supervisor</option>
                                <option value="2">Engineer</option>
                                <option value="3">Administrator</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<select id="company" style="margin-left:128px;" >
                            	<option disabled selected>Select Company</option>
                                <option value="Jump Solutions Inc.">Jump Solutions Inc.</option>
                                <option value="Steadfast Solutions Inc.">Stead Fast Solutions Inc.</option>
                                <option value="Forefront Innovative Technologies Inc.">Forefront Innovative Technologies Inc.</option>
                            </select>
                        </td>
                    </tr>
                </table></center>
    <div style="width:550px; margin-left:auto;">
            <table>              <span id="Regstatus" style="color:#F00;font-weight:bold;"></span>
    <center>
          		<tr>
                	<td>
                	<input type="submit" id="create"  value="create" name="create">
                    </td>
                    <td>
                	<input type="submit" id="reset"  value="reset">
                    </td>
                </tr>
            </table>
              </form>
           </div>

    </div>
</div>
</div>
</div>
<br/>   <br/>
<span>
   <?php include("includes/footer.php"); ?>
</span>
</div>
</body>
</html>