<?php

include("functions/loggedIn.php");
require_once('includes/config.php');

                try{
                      $dbhandler = new PDO( 'mysql:host='.DB_HOST.';dbname='.DB_DATABASE.'',''.DB_USER.'', ''.DB_PASSWORD.'' );
                      $dbhandler->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
                   }catch(PDOException $error){
                      echo "Unexpected Error: ".$error."";

                   }


$tabledata = "";
           ////////////////  ON LOAD //////////////////////////
                       $result = $dbhandler->prepare("SELECT DISTINCT fullname,company,email,phone,mobile FROM gagamit");
                       $result->execute();
           ////////////////////////////////////////////////////

 if (isset($_POST['filter'])){

        $name = $_POST['txtname'];


      switch($_POST['department']){

      case 'CSR':
            if ($_POST['txtname']==""){
                       $result =$dbhandler->prepare("SELECT * FROM gagamit WHERE position = 0 ");
                       $result->execute();
                  }else{
                       $result = $dbhandler->prepare("SELECT * FROM gagamit WHERE position = 0 AND fullname like ? ");
                       $result->execute(array('%'.$name.'%'));
                       }
        break;
      case 'ENGINEER':
             if ($_POST['txtname']==""){

                       $result =$dbhandler->prepare("SELECT * FROM gagamit WHERE position = 2 ");
                       $result->execute();
                  }else{
                       $result = $dbhandler->prepare("SELECT * FROM gagamit WHERE position = 2 AND fullname like ? ");
                       $result->execute(array('%'.$name.'%'));
                       }
       break;
      case 'SUPERVISOR':
             if ($_POST['txtname']==""){
                       $result =$dbhandler->prepare("SELECT * FROM gagamit WHERE position = 1 ");
                       $result->execute();
                  }else{
                       $result = $dbhandler->prepare("SELECT * FROM gagamit WHERE position = 1 AND fullname like ? ");
                       $result->execute(array('%'.$name.'%'));
                       }
      break;

      default:
      if ($_POST['txtname']==""){

                       $result = $dbhandler->prepare("SELECT DISTINCT fullname,company,email,phone,mobile FROM gagamit");
                       $result->execute();

                   }else{

                       $sql=("SELECT DISTINCT fullname,company,email,phone,mobile FROM gagamit WHERE fullname like ?");
                       $result = $dbhandler->prepare($sql);
                       $result->execute(array('%'.$name.'%'));
                        }
       break;

      }
              }



                while($row = $result->fetch(PDO::FETCH_ASSOC)){
				$fullname = $row['fullname'];
				$company = $row['company'];
				$emailadd = $row['email'];
				$phoneno = $row['phone'];
				$mobileno = $row['mobile'];


				$tabledata .= '


				<tr>
                    	<th style="width:200px; height:25px;">'.$fullname.'</a></th>
                        <th style="width:170px; height:25px;">'.$company.'</th>
                        <th style="width:230px; height:25px;">'.$emailadd.'</a></th>
                        <th style="width:165px; height:25px;">'.$phoneno.'</th>
                        <th style="width:130px; height:25px;">'.$mobileno.'</th>


                    </tr>

				';


   	 	}

             $usercount= $result->rowCount();



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

</style>

<link rel="stylesheet" type="text/css" href="menu.css" />
 <link rel="stylesheet" type="text/css" href="css/menu.css" />

</head>

<body>
<div id="container">
	<div id="body">
        	<?php include "includes/header.php" ?>


   		<div id="content">
            <!-- START OF NAVBAR -->
            <?php include("includes/nav.php"); ?>
            <!-- END OF NAVBAR --->
            
            <!-- START OF NAVBAR2 -->
            <div id="navbar2">
            	<table id="navbar3">
                	<tr >
                    	<th style="border:0px solid" width="110px"><a href="dashboard.php">
                        <img src="dashboardicon.png" height="15px" width="15px">
                        Dashboard
                        </a></th>
                        <th style="border:0px solid" width="130px"><a href="staffdirectory.php">
                        <img src="staff.png" height="15px" width="15px">
                        Staff Directory
                        </a></th>
                        <th style="border:0px solid" width="110px"><a href="myprofile.php">
                        <img src="myprofile.png" height="15px" width="15px">
                        My Profile
                        </a></th>
                        
                    </tr>
                </table>
            </div>

            <p id="label2">Staff Directory</p><br>
          <!-- 	<form id="table2">  -->
     <form action="" method="POST">
            	<input id="input" type="text" name="txtname" style="margin-left:10px;">
                <select id="input" name="department">
                	<option>--All Department--</option>
                    <option value="CSR">CSR</option>
                    <option value="SUPERVISOR">SUPERVISOR</option>
                    <option value="ENGINEER">ENGINEER</option>
                </select>
                <input type="submit" value="filter" name ="filter" style="margin-left:10px;">
      </form>
            <br>
            
            <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                <th id="opentickets">Showing <?php echo $usercount ?> users </th>
   		  </Table><br>
                <table id="table2" "margin-left:8px; margin-right:10px;">
                	<tr>
                   	 	<td style="border:1px solid" width="200px">Name</td>
                        <td style="border:1px solid" width="170px">Company</td>
                        <td style="border:1px solid" width="230px">Email Address</td>
                        <td style="border:1px solid" width="165px">Phone Number</td>
                        <td style="border:1px solid" width="130px">Mobile Number</td>
                    </tr>
                  </table>
                  <div id="tickets">
                      <Table id ="table2">
                      <tr>
                   <?php echo $tabledata;?>
                    </tr>

                       </table></div>

    </div>
        </div>
</div><center><font face="century gothic" size="-1"<p>  AtomIT Solutions &copy;  All rights reserved 2014.mpz</center></p>
</body>
</html>