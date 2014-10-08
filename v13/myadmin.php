<?php

include "init.php";

$tabledata = "";
$searchme  = "";


if(isset($_SESSION['username'])){

		$usernamex = $_SESSION['username'];


		                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                        INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                        INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                        ORDER BY sv_ticket_header.date_created DESC");
                        $result->execute();

        if(isset($_POST['filterr'])){

                    $txt_search = $_POST['searchme'];

                          switch($_POST['filterr']){
                            case 'TicketNo':
                                   $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                          INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                          INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                          WHERE sv_ticket_header.sv_number LIKE ?
                                          ORDER BY sv_ticket_header.date_created DESC");
                                   $result->execute(array('%'.$txt_search.'%'));
                            break;
                            case 'Subject':
                                   $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                          INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                          INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                          WHERE sv_ticket_details.subject LIKE ?
                                          ORDER BY sv_ticket_header.date_created DESC");
                                   $result->execute(array('%'.$txt_search.'%'));
                            break;
                            default:
                                   $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                          INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                          INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                                          ORDER BY sv_ticket_header.date_created DESC");
                                   $result->execute();
                            break;
                          }


        }





    echo $loginSuccess = FALSE;
    if($result->rowCount()){

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){

				$ticketID = $row['sv_number'];
				$datecreated = $row['date_created'];
				$from = $row['ticketSender'];
				$assignto = $row['assignto'];
                $fullname = $row['fullname'];
				$subject = $row['subject'];
				$priority = $row['priority'];
				$status = $row['status'];




				$tabledata .= '
				<tr>
                    	<th style="word-break:break-all; width:83px; height:25px;"><a href="adminTickets.php?id='.$ticketID.'" style="color:#0099FF;">'.$ticketID.'</a></th>
                        <th style="word-break:break-all; width:75px; height:25px;">'.$datecreated.'</th>
                        <th style="word-break:break-all; width:250px; height:25px;"><a href="adminTickets.php?id='.$ticketID.'" style="color:#0099FF;">'.$subject.'</a></th>
                        <th style="word-break:break-all; width:170px; height:25px;">'.$from.'</th>
                        <th style="word-break:break-all; width:70px; height:25px;">'.$priority.'</th>
                        <th style="word-break:break-all; width:180px; height:25px;">'.$fullname.'</th>

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
<title>My Admin</title>
<link type="text/css" rel="stylesheet" href="css/myticket.css" />
<link rel="stylesheet" type="text/css" href="css/menu2.css" />

</head>

<body style="background-color: #eeeeee;">
<div id="container">

	<div id="body">

	<?php include "includes/header.php" ?>    

   		<div id="content">

        	<!-- START OF NAVBAR -->
       <!--   <?php include("includes/nav.php"); ?>  -->
         <div class="cssmenu">
   					<a href='dashboard.php'><span>Dashboard</span></a>
   		            <a href='myadmin' class='current'><span>Tickets</span></a>
                    <a href='myadminWorkOrder'><span>WorkOrders</span></a>
                    <a href='managestaff.php'><span>Manage Staff</span></a>
         </div>
<div class="cssmenusub">
            <!-- END OF NAVBAR --->

            <!-- START OF NAVBAR2 -->
         <?php  include "includes/Access.php"; ?>
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
                    	<th id="opentickets">TICKETS</th>
                    </tr>
           		</Table>

                <Table id="table2">
                  <tr>
                    	<th style="width:83px; height:25px;">Ticket</th>
                        <th style="width:75px; height:25px;">Date</th>
                        <th style="width:250px; height:25px;">Subject</th>
                        <th style="width:170px; height:25px;">From</th>
                        <th style="width:70px; height:25px;">Priority</th>
                        <th style="width:180px; height:25px;">Assigned To: (Supervisor)</th>
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