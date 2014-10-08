<?php
include("init.php");
include("functions/loggedIn.php");


if(isset($_SESSION['username'])){

    $passw=DB::getInstance()->prepare("SELECT * FROM gagamit where user_name =?");
    $passw->execute(array($_SESSION['username']));
     	while ($row = $passw->fetch(PDO::FETCH_ASSOC)) {
                $position = $row['position'];
                      switch($position){
                        case 0:
                            $hdr = '<div class="cssmenu"><a href="myticket"><span>My Tickets</span></a></div>';
                        break;
                        case 1:
                            $hdr = '<div class="cssmenu"><a href="myassignticket"><span>My AssignTicket</span></a></div>';
                        break;
                        case 2:
                            $hdr = '<div class="cssmenu"><a href="myworkorder"><span>Workorder</span></a></div>';
                        break;
                        case 3:
                            $hdr = '<div class="cssmenu"><a href="myadmin"><span>Tickets</span></a></div>';
                        break;
          }
        }
}


?>

<html>
<head>
<meta charset="utf-8">
<title>Change Password</title>
<link type="text/css" rel="stylesheet" href="css/ChangePass.css" />
	<link rel="stylesheet" type="text/css" href="css/menu2.css" />
</head>
<body>

<div id="container">
	<div id="body">
    <div id="logout">Welcome, <a href="changepass.php" style="color:#06F;text-transform:capitalize"><?php echo $_SESSION['username']; ?></a> | <a href="logout.php"><font color="orange">Logout</font></a></div>

<div id="header">
<?php
    $error1="";
    $error2="";

if (isset($_POST['newpass'])){





    $passw=DB::getInstance()->prepare("SELECT pass_word FROM gagamit where user_name =?");
    $passw->execute(array($_SESSION['username']));

                 	while ($row = $passw->fetch(PDO::FETCH_ASSOC)) {
                $passwo = $row['pass_word'];
               //  $row = $passw->fetch_object();
             //   $passwo = $row->password;

//
     if (hash("sha256",$_POST['oldpass']) == $passwo){


        if (hash("sha256",$_POST['newpass'])==hash("sha256",$_POST['repass'])){


         $result=DB::getInstance()->prepare("UPDATE gagamit SET pass_word= ? WHERE user_name= ?");
         $result->execute(array(hash("sha256",$_POST['newpass']),$_SESSION['username']));

            $error1="Password successfully changed!";


         }else{ $error2="*Password do not match!"; }
         }else{ $error1="*Incorrect password!"; }

	}
	}

    ?>

   </div>     	  <!-- START OF NAVBAR -->
          <!--		<?php include("includes/nav.php"); ?> -->

            <!-- END OF NAVBAR --->

            <!-- START OF NAVBAR2 -->
            <!--	<?php include("includes/ticket_navigation.php"); ?> -->
        <?php echo $hdr; ?>

      <div class="cssmenusub">



            <!-- END OF NAVBAR2 -->
   	      <div id="tickets">
            	<table style="margin-left:auto; margin-right:auto;">
                	<br />
                    <tr>
                    	<th id="labelpass">Change Password</th>
                    </tr>
           		</table>


            </div>

 <form method='post' action='changepass.php' >
          	<table style="margin-left:auto; margin-right:auto;">
                   <tr>
                  <td><label id="label" style="color:red" ><?php echo $error2; ?></label></td>
                  <td><label id="label" style="color:red" ><?php echo $error1; ?></label></td>
                  </tr>
              </table>

   	<table style="margin-left:auto; margin-right:auto;">




                 <tr>
                    <td>Old Password:</td>
                    <td><input name='oldpass' type='password' id='password' required/></td>
                    <br>
                    </br>

                    </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input name='newpass' type='password' id='password' required/>

                    </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input name='repass' type='password' id='password' required/></td>

                </tr>
          </table>

      <table style="margin-left:auto; margin-right:auto;">
                 <tr>
                   <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                    <td><input type='submit' value=' Done ' name="btnchange" id='submit' align="middle"/> </td>

               </tr>
      </table>

          <table>
               <tr>
               </tr>
         </table>
         </div>
         </div>
    </div>

</form>

</body>
</html>