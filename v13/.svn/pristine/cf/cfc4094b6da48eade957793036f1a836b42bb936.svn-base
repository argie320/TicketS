<?php
include("init.php");
include("functions/loggedIn.php");
//include("asset/DB.php");


$tabledata = "";

if(isset($_SESSION['username'])){


    $sql = "SELECT DISTINCT * FROM sv_ticket_header
                                 INNER JOIN wo_ticket_details
                                        ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                 INNER JOIN sv_ticket_details
                                        ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
								 INNER JOIN gagamit 
								        ON sv_ticket_header.assignto = gagamit.email
                                 ORDER BY wo_ticket_details.wo_date_created DESC";



	if(isset($_GET['status'])){

		/*
		switch($_GET['status']){
			case 'Open':
				 $sql =	"SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                         WHERE gagamit.user_name =  '".$_SESSION['username']."' AND sv_ticket_header.status = 'Open'
						 ORDER BY sv_ticket_header.date_created DESC";
				break;
				
			case 'Overdue':
			
				$sql = "SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                         WHERE gagamit.user_name =  '".$_SESSION['username']."' AND sv_ticket_header.isOverdue = 1
						 ORDER BY sv_ticket_header.date_created DESC";
				break;
		   
		   case 'Answered':
			
				$sql = "SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                         WHERE gagamit.user_name =  '".$_SESSION['username']."' AND sv_ticket_header.response = 1
						 ORDER BY sv_ticket_header.date_created DESC";
				break;
				
		   case 'ClosedTicket':
			
				$sql = "SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                         WHERE gagamit.user_name =  '".$_SESSION['username']."' AND sv_ticket_header.status = 'Closed'
						 ORDER BY sv_ticket_header.date_created DESC";
				break;
				
		default :
			   $sql = "SELECT * FROM sv_ticket_header
                        INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                        INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                        WHERE gagamit.user_name =  '".$_SESSION['username']."' ORDER BY sv_ticket_header.date_created DESC";
					
				break;
		}
		*/
	}

    $result = DB::getInstance()->query($sql);

    echo $loginSuccess = FALSE;
    if($result->rowCount()){

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
				
				$ticketID = $row['sv_number'];
				$datecreated = $row['created'];
		     	$from = $row['ticketSender'];
				$assignto = $row['assignToEngineer'];
				$subject = $row['subject'];
				$priority = $row['priority'];
				$status = $row['status'];
                $fullname = $row['fullname'];
                 $log = $row['log_ID'];




				$tabledata .= '
        		<tr>
                    	<th style="word-break:break-all; width:83px; height:25px;"><a href="adminWorkOrder.php?id='.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$ticketID.'</a></th>
                        <th style="word-break:break-all; width:75px; height:25px;">'.$datecreated.'</th>
                        <th style="word-break:break-all; width:250px; "height:25px;"><a href="adminWorkOrder.php?id='.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$subject.'</a></th>
                        <th style="word-break:break-all; width:170px; height:25px;">'.$from.'</th>
                        <th style="word-break:break-all; width:70px; height:25px;">'.$priority.'</th>
                        <th style="word-break:break-all; width:180px; height:25px;">'.$assignto.'</th>
                    </tr>
				';

			}




	}



}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>My Admin Workorder</title>
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
       <!--   <?php include("includes/nav.php"); ?>  -->
         <div class="cssmenu">
   					<a href='dashboard.php'><span>Dashboard</span></a>
   		            <a href='myadmin'><span>Tickets</span></a>
                    <a href='myadminWorkOrder' class='current'><span>WorkOrders</span></a>
                    <a href='managestaff.php'><span>Manage Staff</span></a>
         </div>
<div class="cssmenusub">
            <!-- END OF NAVBAR --->

            <!-- START OF NAVBAR2 -->
            <?php

			
			
$ticketstatusCounter =  "SELECT DISTINCT * FROM sv_ticket_header
                                 INNER JOIN wo_ticket_details
                                        ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                 INNER JOIN sv_ticket_details
                                        ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
								 INNER JOIN gagamit 
								        ON sv_ticket_header.assignto = gagamit.email
                                 ORDER BY wo_ticket_details.wo_date_created DESC";
                        $result->execute();

$statusresult = DB::getInstance()->query($ticketstatusCounter);


        		$ticketOpenNumber = 0;
				$ticketOverdueNumber = 0;
				$ticketClosedNumber = 0;
				$ticketAnsweredNumber = 0;
				$myticketcount = 0;


			if($statusresult->rowCount()){



				while ($row = $statusresult->fetch(PDO::FETCH_ASSOC)){

					$openTicket = $row['status'];
					$ticketOverdue = $row['isOverdue'];
					$ticketResponse = $row['response'];

					($openTicket == "Closed") ? $ticketClosedNumber++ : "error";
					($openTicket == "Open") ? $ticketOpenNumber++ : "error";
					($ticketResponse == 1) ? $ticketAnsweredNumber++ : "error";
					($ticketOverdue == 1) ? $ticketOverdueNumber++ : "error";


					$myticketcount++;

				}
			}

?>

<div id="navbar2">
            	<table id="navbar3">
                	<tr >


                        <th style="border:0px solid" width="150px"><a href="myadminWorkOrder">
                        <img src="images/myticket.png" height="15px" width="20px">
                        All Workorders(<?php echo (isset($myticketcount)) ? $myticketcount : "e"; ?>)
                        </a></th>
    

                    </tr>
                </table>
            </div>
            <!-- END OF NAVBAR2 -->

            <!-- START OF SEARCHBAR -->
            <div id="searchbar">
            	<form action="" method="POST">
                	<input type="text" name="searchme">
                <select id="input" name="filterr">
                	<option>--Filter by--</option>
                    <option value="TicketNo">TicketNo</option>
                    <option value="Subject">Subject</option>
                </select>
                    <input type="submit" name="searchbutton" value="Search" class="myButton">
             <!-- <input id="refresh" type="submit" name="refreshbutton" value="Refresh" class="myButton"> -->
                </form>

            </div>

            <!-- END OF SEARCHBAR -->
            <div id="tickets">

                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets">WORKORDERS</th>
                    </tr>
           		</Table>

                <Table id="table2">
                  <tr>
                    	<th style="width:83px; height:25px;">Ticket</th>
                        <th style="width:75px; height:25px;">Date</th>
                        <th style="width:250px; height:25px;">Subject</th>
                        <th style="width:170px; height:25px;">From</th>
                        <th style="width:70px; height:25px;">Priority</th>
                        <th style="width:180px; height:25px;">Assigned To: (Engineer)</th>
                    </tr>
            </Table>
          <div id="ticket">
          <Table id ="table2">
                         <tr>
         <?php echo $tabledata; ?>
                     </tr>
         </Table>
       </div>
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