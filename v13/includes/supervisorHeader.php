<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/5/14
 * Time: 2:07 PM
 */
?>
<!-- START OF NAVBAR -->
 <!-- <div id="cssmenu">
    <ul>
        <li><a href='dashboard.php'><span>Dashboard</span></a></li>
        <li><a href='myassignticket'><span>Tickets</span></a></li>
        <li><a href='sv_myworkorder?'><span>Work Order</span></a></li>
   <li><a href='workOrderStatus?'><span>Work Order</span></a></li>

    </ul>
</div>  -->
<!-- END OF NAVBAR --->
<?php
$ticketstatusCounter =	   "SELECT * FROM sv_ticket_header 
                               INNER JOIN gagamit 
							      ON sv_ticket_header.assignto = gagamit.email
							   INNER JOIN ticket_status
							      ON sv_ticket_header.log_ID = ticket_status.log_ID  
WHERE gagamit.user_name =  '".$_SESSION['username']."'";


$statusresult = DB::getInstance()->query($ticketstatusCounter);


$ticketOpenNumber = 0;
$ticketOverdueNumber = 0;
$ticketClosedNumber = 0;
$ticketAnsweredNumber = 0;
$myticketcount = 0;

if($statusresult->rowCount()){



    while ($row = $statusresult->fetch(PDO::FETCH_ASSOC)){

        $openTicket = $row['isOpen'];
		$closedTicket = $row['isClosed'];
        $ticketOverdue = $row['isOverdue'];
      // $ticketResponse = $row['isAnswered'];


        ($openTicket == 1) ? $ticketOpenNumber++ : "error";
        ($closedTicket == 1) ? $ticketClosedNumber++ : "error";
       // ($ticketResponse == 1) ? $ticketAnsweredNumber++ : "error";
        ($ticketOverdue == 1) ? $ticketOverdueNumber++ : "error";


        $myticketcount++;

    }
}


     $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
                         WHERE gagamit.user_name = ? 
						 AND sv_ticket_header.isClosed= 0
						 AND sv_ticket_header.response = 1
						 AND gagamit.position=1
						 ORDER BY sv_ticket_header.date_created DESC");
                         $result->execute(array($_SESSION['username']));
		if($result->rowCount()){  while ($row = $result->fetch(PDO::FETCH_ASSOC)){				 
						 $ticketResponse = $row['response'];
						 ($ticketResponse == 1) ? $ticketAnsweredNumber++ : "error"; }}
						 
                                            

?>

<div id="navbar2">
    <table id="navbar3">
        <tr >
            <th style="border:0px solid" width="80px"><a href="myassignticket?status=Open">
                    <img src="images/open.png" height="15px" width="15px">
                    Open(<?php echo $ticketOpenNumber; ?>)
                </a></th>
            <th style="border:0px solid" width="110px"><a href="myassignticket?status=Answered">
                    <img src="images/answered.png" height="15px" width="15px">
                    Answered(<?php echo $ticketAnsweredNumber; ?>)
                </a></th>
            <th style="border:0px solid" width="110px"><a href="myassignticket">
                    <img src="images/myticket.png" height="15px" width="15px">
                    My Tickets(<?php echo (isset($myticketcount)) ? $myticketcount : "e"; ?>)
                </a></th>
            <th style="border:0px solid" width="100px"><a href="myassignticket?status=Overdue">
                    <img src="images/overdue.png" height="15px" width="15px">
                    Overdue(<?php echo $ticketOverdueNumber; ?>)
                </a></th>
            
            <th style="border:0px solid" width="130px"><a href="myassignticket?status=ClosedTicket">
                    <img src="images/closed.png" width="15px" height="15px">
                    Closed Tickets(<?php echo $ticketClosedNumber; ?>)
                </a></th>
        </tr>
    </table>
</div>