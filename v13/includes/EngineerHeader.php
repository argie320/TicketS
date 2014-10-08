
<?php

                   $ticketstatusCounter = "SELECT * 
							  FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name ='".$_SESSION['username']."'
							  AND ticket_status.isWOClosed = 0
							  AND ticket_status.isWOOpen = 1
							  AND gagamit.position = 2";
                   

$statusresult = DB::getInstance()->query($ticketstatusCounter);


$ticketOpenNumber = 0;
$ticketOverdueNumber = 0;
$ticketClosedNumber = 0;
$ticketAnsweredNumber = 0;



if($statusresult->rowCount()){



    while ($row = $statusresult->fetch(PDO::FETCH_ASSOC)){

        $openTicket = $row['isWOOpen'];
        $ticketOverdue = $row['isWOOverdue'];
        $ticketResponse = $row['isWOAnswered'];

		
		

 
        ($openTicket ==1) ? $ticketOpenNumber++ : "error";
        ($ticketResponse == 1) ? $ticketAnsweredNumber++ : "error";
        ($ticketOverdue == 1) ? $ticketOverdueNumber++ : "error";

   



    }
}


////////////  PULOUT SLIP ///////////////
$pulloutQry ="SELECT * FROM wo_ticket_details 
                                       INNER JOIN tb_pullout ON wo_ticket_details.log_No = tb_pullout.log
                                       INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email
									   INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
									   INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID  
									   WHERE gagamit.user_name = '".$_SESSION['username']."'
									   AND ticket_status.isWOClosed = 1 OR ticket_status.isWOOpen = 1";
$pullout = DB::getInstance()->query($pulloutQry);
$pulloutCount = 0;
if($pullout->rowCount()){
while ($row = $pullout->fetch(PDO::FETCH_ASSOC)){   $pulloutCount++;  }}

////////////////////////////////////////

////////////  RETURN SLIP ///////////////

$returnQry ="SELECT * FROM wo_ticket_details 
                                       INNER JOIN tb_return ON wo_ticket_details.log_No = tb_return.log
                                       INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
									   INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
									   INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID 
									   WHERE gagamit.user_name = '".$_SESSION['username']."'
									   AND ticket_status.isWOClosed = 1 OR ticket_status.isWOOpen = 1";
$return = DB::getInstance()->query($returnQry);
$returnCount = 0;
if($return->rowCount()){
while ($row = $return->fetch(PDO::FETCH_ASSOC)){   $returnCount++;  }}

////////////////////////////////////////

$ClosedQry ="SELECT * FROM wo_ticket_details 
                                       INNER JOIN tb_return ON wo_ticket_details.log_No = tb_return.log
                                       INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
									   INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID 
									   INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
									   WHERE gagamit.user_name = '".$_SESSION['username']."'
									   AND ticket_status.isWOClosed = 1
									   AND ticket_status.isWOOpen = 0 ";
$closed = DB::getInstance()->query($ClosedQry);
$ticketClosedNumber = 0;
if($closed->rowCount()){
while ($row = $closed->fetch(PDO::FETCH_ASSOC)){   $ticketClosedNumber++;  }}

////////////////////////////////////////

$ticketQry ="SELECT * 
							  FROM wo_ticket_details 
				              INNER JOIN sv_ticket_header ON wo_ticket_details.log_No = sv_ticket_header.log_ID
                              INNER JOIN sv_ticket_details ON wo_ticket_details.log_No = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON wo_ticket_details.log_No =ticket_status.log_ID
                              INNER JOIN gagamit ON wo_ticket_details.assignToEngineer = gagamit.email 
							  WHERE gagamit.user_name ='".$_SESSION['username']."'
							  AND gagamit.position = 2";
$tickets = DB::getInstance()->query($ticketQry);
$myticketcount = 0;
if($tickets->rowCount()){
while ($row = $tickets->fetch(PDO::FETCH_ASSOC)){   $myticketcount++;  }}

//////////////////////////////////////////

?>
              <div id="navbar2">
            	<table id="navbar3">
                	<tr >

                        <th style="border:0px solid" width="80px"><a href="myworkorder?status=Open">
                        <img src="images/open.png" height="15px" width="15px">
                        Open(<?php echo $ticketOpenNumber; ?>)
                       </a></th>
                       <th style="border:0px solid" width="110px"><a href="myworkorder?status=Answered">
                       <img src="images/answered.png" height="15px" width="15px">
                        Answered(<?php echo $ticketAnsweredNumber; ?>)
                       </a></th>
                        <th style="border:0px solid" width="130px"><a href="myworkorder">
                        <img src="images/myticket.png" height="15px" width="15px">
                        My Workorder(<?php echo (isset($myticketcount)) ? $myticketcount : "e"; ?>)
                        </a></th>
                       <th style="border:0px solid" width="100px"><a href="myworkorder?status=Overdue">
                       <img src="images/overdue.png" height="15px" width="15px">
                        Overdue(<?php echo $ticketOverdueNumber; ?>)
                       </a></th>
                       <th style="border:0px solid" width="130px"><a href="myworkorder?status=ClosedTicket">
                       <img src="images/closed.png" width="15px" height="15px">
                        Closed Tickets(<?php echo $ticketClosedNumber; ?>)
                        </a></th> 
                        <th style="border:0px solid" width="100px"><a href="myworkorder?status=pullout">
                        <img src="images/535129-print_512x512.png" height="15px" width="15px">
                        Pull Out(<?php echo (isset($pulloutCount)) ? $pulloutCount : "e"; ?>)
                        </a></th>
                        <th style="border:0px solid" width="100px"><a href="myworkorder?status=returned">
                        <img src="images/535129-print_512x512.png" height="15px" width="15px">
                        Returned(<?php echo (isset($returnCount)) ? $returnCount : "e"; ?>)
                        </a></th>

                    </tr>
                </table>
            </div>