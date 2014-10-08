<?php
  $oldpassVal="";
  $retypepassVal="";

include("functions/loggedIn.php");
include_once('asset/DB.php');

               $result = DB::getInstance()->query("SELECT DISTINCT pass_word,fullname,email,phone,mobile FROM gagamit WHERE user_name =  '".$_SESSION['username']."'");
                while($row = $result->fetch(PDO::FETCH_ASSOC)){
				$fullname = $row['fullname'];
				$emailadd = $row['email'];
				$phoneno = $row['phone'];
				$mobileno = $row['mobile'];

                $passwo = $row['pass_word'];
                		}

if (isset($_POST['submit'])){


 if (isset($_POST['newpass'])){

   $txtfullname = $_POST['fullname'];
   $txtemail = $_POST['emailadd'];
   $txtphoneno = $_POST['phoneno'];
   $txtmobileno = $_POST['mobileno'];


//   if($txtfullname == "" || $txtemail == "" || $txtphoneno == "" || $txtmobileno == ""){

   //    echo "Please fill all the fields";

 //  }else{


  if (hash("sha256",$_POST['oldpassword']) == $passwo){


        if (hash("sha256",$_POST['newpass'])==hash("sha256",$_POST['retypepassword'])){

              $result = DB::getInstance()->query("UPDATE gagamit SET pass_word='" .hash("sha256",$_POST['newpass']). "'
              ,fullname='" .$txtfullname. "'
              ,email='" .$txtemail. "'
              ,phone='".$txtphoneno."'
              ,mobile='".$txtmobileno."'
              WHERE user_name='". $_SESSION['username'] ."'");

              header("Location: myprofile.php");

              }else{
                      $retypepassVal = "Password do not match";
                   }
          }else{
                 $oldpassVal = "Incorrect password";
               }

                             }
              }
   //   }
?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style type="text/css">
*{
	border:0;
	margin:0;

	}

#container {
	clear: both;
	position:absolute;
	height: auto;
	width: 100%;
	border-width: 0px;
	border-style: solid;
	background-color: #eeeeee;
}

#body {
	width: 960px;
	height:720px;
	border-width: 1px;
	border-style: solid;
	border-color:#666;
	margin-left:auto;
	margin-right:auto;
	background-color: #FFF;
	box-shadow: 4px 4px 1px #888888

	}

#header {
	height:75px;
	width:960px;
	margin: 1px;
	background-image:url(images/logo.png);
	border-bottom:1px solid #666;
	}

#logout {
	height:35px;
	width:400px;
	margin-right:10px;
	margin-top: 8px;
	padding-top:10px;
	float:right;
	border:1px solid #666;
	text-align:center;
	background-color: #eeeeee;


	}

#content {
	width:960px;
	height:500px;
	border: 0px solid black;
	}

#navbar {
	height: 40px;
	width:960px;
	border: 0px solid black;

	}

#navbar2 {
	height: 40px;
	width:960px;
	border: 0px solid black;
	border-bottom:1px solid #666;
	margin-top: 5px;
	}
	
#navbar3 {
	margin-left:10px;
	text-align:center;
	
	}
	
A:link { COLOR: black; TEXT-DECORATION: none;  }
A:visited { COLOR: black; TEXT-DECORATION: none;  }
A:active { COLOR: black; TEXT-DECORATION: none }
A:hover { COLOR: #666; TEXT-DECORATION: none;  }
	

#refresh {
	float:right;
	margin-right: 10px;
}

#table,th,td
{
	border:1px solid #666;
	border-collapse:collapse;
	margin-left:10px;
	margin-right:10px;
	font-family:century gothic;
	font-size:10pt;

}
th,td
{
	padding:5px;
	
}

#opentickets {
	border:0px;
	width:930px;
	text-align:left;
	background-color:#333;
	color:#FFF;
	font-size:11pt;
	
	}

#opentickets2 {
	border:0px;
	width:930px;
	text-align:left;
	background-color:#eeeeee;
	color:#333;
	font-size:11pt;
	
	}

#input  {
	
	border: 1px solid #666666;
	width: 200px;	
	margin-left: 30px;
 	font:10pt century gothic;
	border-bottom:#333;
}

#input2  {
	
	border: 1px solid #666666;
	width: 200px;	
	margin-left: 80px;
 	font:10pt century gothic;
	border-bottom:#333;
}
#inputtime  {
	
	border: 1px solid #666666;
	width: 350px;	
	margin-left: 10px;
 	font:10pt century gothic;
	border-bottom:#333;
}
#textarea  {
	border: 1px solid #666666;
	width: 700px;	
	height: 200px;
	margin-left: 35px;
 	font:10pt century gothic;
	border-bottom:#333;
}
#textarea2  {
	border: 1px solid #666666;
	width: 700px;	
	height: 100px;
	margin-left: 35px;
 	font:10pt century gothic;
	border-bottom:#333;
}
#issueinput  {
	
	border: 1px solid #666666;
	width: 400px;	
	margin-left: 35px;
 	font:10pt century gothic;
	border-bottom:#333;
}

#label {
	margin-left: 0px;
	font: 10pt century gothic;
	color:#666;
	
	}

#submit {
	margin:auto;
	font: 10pt century gothic;
	color:#666;
	
	}
#submit2{
	margin:auto;
	text-align:center;
	alignment:center;
	font: 10pt century gothic;
	color:#666;
	border-color:#333;
	
	}

#table th,td{
		border-style:hidden;
		margin-left:10px;
		
		}
#table {
	margin-top:-30px;
	
	}	
	
#table2 {margin-left:10px}



</style>

<link rel="stylesheet" type="text/css" href="menu.css" />
<link rel="stylesheet" type="text/css" href="css/menu.css" />
</head>

<body>
<div id="container">
	<div id="body">
  <?php include "includes/header.php"; ?>
   		<div id="content">
        	<!-- START OF NAVBAR -->
        		<?php include("includes/nav.php"); ?>
            <!-- END OF NAVBAR --->
            
            <!-- START OF NAVBAR2 -->
            	<?php include("includes/ticket_navigation.php"); ?>
            <!-- END OF NAVBAR2 -->
            <div="tickets">
            	<br>
            	<Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets">MY ACCOUNT PROFILE</th>
                    </tr>
                    <tr>
                    	<th id="opentickets2">User Information</th>
                    </tr>
           		</Table>
                <table id="table2">
                    <form method='post' action='myprofile.php' >
                    	<tr>

                        </tr>
                        <tr>
                        	<td>
                            	<label id="label">FullName:</label>
                            </td>
                            <td>
                            	<input id="input2" type="text" name="fullname" value="<?php echo $fullname;?>" required/>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<label id="label">Email Address:</label>
                            </td>
                            <td>
                            	<input id="input2" type="text" name="emailadd" value="<?php echo $emailadd;?>" required/>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<label id="label">Phone Number:</label>
                            </td>
                            <td>
                            	<input id="input2" type="text" name="phoneno" value="<?php echo $phoneno;?>" required/>
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<label id="label">Mobile Number:</label>
                            </td>
                            <td>
                            	<input id="input2" type="text" name="mobileno" value="<?php echo $mobileno;?>" required/>

                            </td>
                        </tr>
                <!--    </form>     -->
                </table><br>


                <!-- START OF RENEW PASSWORD!! -->
                <Table style="margin-left:auto; margin-right:auto;">
                    <tr>
                    	<th id="opentickets2">
                        Password: To reset your password, provide your current password and a new password below.
                        </th>
                    </tr>
           		</Table><br>
                <table id="table2">
                	<tr>
                    	<td>
                        	<label id="label">Current Password:</label>
                        </td>
                        <td>
                        	<input id="input" type="password" name="oldpassword" required/>
                                 <label id="label" style="color: red"><?php echo $oldpassVal ?></label>
                        </td>
                    </tr>
                    <Tr>
                    	<td>
                        	<label id="label">New Password:</label>
                        </td>
                        <td>
                        	<input id="input" type="password" name="newpass" required/>

                        </td>
                    </Tr>
                    <tr>
                    	<td>
                        	<label id="label">Confirm New Password:</label>
                        </td>
                        <td>
                        	<input id="input" type="password" name="retypepassword" required/>
                             <label id="label" style="color: red"><?php echo $retypepassVal ?></label>
                        </td>
                    </tr>
                </table>
                <!-- END OF RENEW PASSWORD!! -->
                <br><Br>
                             <table> <center>
                           <!--	<form id="submit2"> -->
                        		<input id="submit" name="submit" type="submit" value="Save Changes">
                           </center>       </table>
                        	</form>
           </div>
        </div>
        <center>
        <font face="century gothic" size="-1"<p>  AtomIT Solutions &copy;  All rights reserved 2014.mpz</p></center>

    </div>
</div>

</body>
</html>