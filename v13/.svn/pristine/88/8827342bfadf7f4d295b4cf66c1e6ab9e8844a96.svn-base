<?php

include("init.php");

$tabledata = "";



if(isset($_SESSION['username'])){

     if(isset($_GET['email'])){

                if($_GET['email']==""){
                         $result = DB::getInstance()->prepare("SELECT * FROM gagamit ORDER BY registration_date DESC");
                        $result->execute();
                      }else{
                        $result = DB::getInstance()->prepare("DELETE FROM gagamit WHERE email=?");
                        $result->execute(array($_GET['email']));
                        header("Location: managestaff.php");
                            }
     }else{

                if(isset($_POST['searchbutton'])){

                                $searchme = $_POST['searchme'];

                           switch($_POST['filterr']){
                               case 'Name':
                                   $result = DB::getInstance()->prepare("SELECT * FROM gagamit WHERE fullname like ? ORDER BY registration_date DESC");
                                   $result->execute(array('%'.$searchme.'%'));
                                break;
                               case 'Company':

                                   $result = DB::getInstance()->prepare("SELECT * FROM gagamit WHERE company like ? ORDER BY registration_date DESC");
                                   $result->execute(array('%'.$searchme.'%'));
                                break;
                               default:
                                   $result = DB::getInstance()->prepare("SELECT * FROM gagamit ORDER BY registration_date DESC");
                                   $result->execute();
                                break;
                           }
                 }else{

                    $result = DB::getInstance()->prepare("SELECT * FROM gagamit ORDER BY registration_date DESC");
                    $result->execute();


                      }
          }



  //  $result = DB::getInstance()->query($sql);

    echo $loginSuccess = FALSE;
    if($result->rowCount()){

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){

				$fullname = $row['fullname'];
				$reg_date = $row['registration_date'];
				$emailadd = $row['email'];
				$position = $row['position'];
				$company = $row['company'];
                switch($position){
                  case '0': $pos="Customer Sales Representative"; break;
                  case '1': $pos="Supervisor"; break;
                  case '2': $pos="Engineer"; break;
                  case '3': $pos="Administrator"; break;
                }



				$tabledata .= '

                    <tr>

                    	<th style="word-break:break-all; width:142px; height:25px;">'.$reg_date.'</a></th>
                        <th style="word-break:break-all; width:160px; height:25px;">'.$fullname.'</th>
                        <th style="word-break:break-all; width:228px; height:25px;">'.$emailadd.'</a></th>
                        <th style="word-break:break-all; width:157px; height:25px;">'.$company.'</th>
                        <th style="word-break:break-all; width:127px; height:25px;">'.$pos.'</th>
                        <th style="word-break:break-all; width:20px; height:25px;"><a href="managestaff.php?email='.$emailadd.'" style="color:#0099FF;"><img src="images/delete.png" height="15px" width="15px"></a></th>

                    </tr>


				';

			}


	}


}else{
  header("Location: logout.php");
}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ManageStaff</title>

<!-- <style type="text/css">
*{
	border:0;
	margin:0;

	}

#container {
	clear: both;
	position:absolute;
	height: 100%;
	width: 100%;
	border-width: 0px;
	border-style: solid;
	background-color: #eeeeee;
}

#body {
	width: 1100px;
	height:600px;
	border-width: 1px;
	border-style: solid;
	border-color:#666;
	margin-left:auto;
	margin-right:auto;
	background-color: #FFF;
	box-shadow: 4px 4px 1px #888888;


	}

#header {
	height:75px;
	width:1100px;
	margin:auto;
	background-image:url(images/logo2.png);
	border-bottom:1px solid #667;

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
	width:1100px;
	height:500px;
	border: 0px solid black;
	}

#navbar {
	height: 40px;
	width:1100px;
	border: 0px solid black;

	}

#navbar2 {
	height: 40px;
	width:1100px;
	border: 0px solid black;
	border-bottom:1px solid #666;
	margin-top: 5px;
	}

#navbar3 {
	margin-left:10px;

	}

A:link { COLOR: black; TEXT-DECORATION: none;  }
A:visited { COLOR: black; TEXT-DECORATION: none;  }
A:active { COLOR: black; TEXT-DECORATION: none; }
A:hover { COLOR: #666; TEXT-DECORATION: none;  }

#searchbar {
	height: 65px;
	width:1100px;
	border: 0px solid black;
	}

#searchbar input  {

	border: 1px solid #666666;
	margin-bottom: 5px;
	margin-top: 10px;
	width: 200px;
	margin-left:10PX;
 	font:11pt century gothic;

}

#searchbar input[type="submit"] {
	border: 1px solid #666666;
	margin-bottom: 5px;
	margin-top: 10px;
	width: 100px;
	margin-left:10PX;
 	font:11pt century gothic;


}

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
	width:1070px;
	text-align:left;
	background-color:#333;
	color:#FFF;
	font-size:13px;
	}

#label {
	margin-left: 10px;
	font: 10pt century gothic;
	color:#666;
	}

#label2 {
	margin-left: 20px;
	font: 20pt century gothic;
	color:#333;
	}

#table2 {margin-left:10px}

#input  {

	border: 1px solid #666666;
	width: 200px;
	margin-left: 10px;
 	font:10pt century gothic;
	border-bottom:#333;
}

#submit {
	margin-left: 20px;
	font: 10pt century gothic;
	color:#666;
	}


  #tickets {
      overflow: auto;
      height: 240px;
   }

</style> -->

<link type="text/css" rel="stylesheet" href="css/myticket.css" />
<link rel="stylesheet" type="text/css" href="css/menu2.css" />

</head>

<body style="background-color: #eeeeee;">
<div id="container">

	<div id="body">

     <div id="header">

   <div id="logout">Welcome, <a href="adminChangePass.php" style="color:#06F;text-transform:capitalize"><?php echo $_SESSION['username']; ?></a> | <a href="logout.php"><font color="orange">Logout</font></a></div>


</div>

   		<div id="content">

        	<!-- START OF NAVBAR -->
       <!--   <?php include("includes/nav.php"); ?>   -->

                   	<div class="cssmenu">

   					<a href='myadmin.php'><span>Tickets</span></a>
                    <a href='myadminWorkOrder.php'><span>WorkOrders</span></a>
                    <a href='managestaff.php' class="current"><span>Manage Staff</span></a>
                    <a href='createuser.php'><span>Create User</span></a>
                 </div>
                 <div class="cssmenusub">

            <!-- END OF NAVBAR --->
           <div id="navbar2">
                      	<table id="navbar3">

                </table>
            </div>
            <!-- START OF NAVBAR2 -->
        <!--   <?php include("includes/ticket_navigation.php"); ?> -->
            <!-- END OF NAVBAR2 -->

            <!-- START OF SEARCHBAR -->
            <div id="searchbar">
            	<form action="" method="POST">
                	<input type="text" name="searchme">
                <select id="input" name="filterr">
                	<option>--Filter by--</option>
                    <option value="Name">Name</option>
                    <option value="Company">Company</option>
                </select>
                    <input type="submit" name="searchbutton" value="Search" class="myButton">

                </form>

            </div>

            <!-- END OF SEARCHBAR -->


                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets">List of users</th>
                    </tr>
           		</Table>

                <table id="table2">
                   <tr>

                        <td style="border:1px solid" width="142px">Registration Date</td>
                        <td style="border:1px solid" width="160px">FullName</td>
                        <td style="border:1px solid" width="228px">Email</td>
                        <td style="border:1px solid" width="157px">Company</td>
                        <td style="border:1px solid" width="128px">Position</td>
                        <td style="width:20px; height:25px;"></td>

                    </tr>
            </table>
          <div id="tickets">
          <Table id ="table2">
                    <tr>

         <?php echo $tabledata; ?>
                     </tr>
         </Table>
       </div>


        <!-- end of content -->
        </div>

    <!-- end of body -->
    </div>
    </div>
<!-- end of container -->
<br/>
<span>
   <?php include("includes/footer.php"); ?>
</span>
</div>
</body>
</html>