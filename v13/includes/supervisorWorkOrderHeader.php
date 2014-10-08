<?php 

                   $ticketstatusCounter = "SELECT * 
							  FROM sv_ticket_header 
				              INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
                              INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID
                              INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email 
							  WHERE gagamit.user_name ='".$_SESSION['username']."'
							  AND ticket_status.isWOClosed = 0
							  AND ticket_status.isWOOpen = 1
							  AND gagamit.position = 1";
                   

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
$pulloutQry ="SELECT * FROM sv_ticket_header INNER JOIN tb_pullout ON sv_ticket_header.log_ID = tb_pullout.log
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name = '".$_SESSION['username']."'
									   AND ticket_status.isWOClosed = 1  OR ticket_status.isWOOpen = 1";
$pullout = DB::getInstance()->query($pulloutQry);
$pulloutCount = 0;
if($pullout->rowCount()){
while ($row = $pullout->fetch(PDO::FETCH_ASSOC)){   $pulloutCount++;  }}

////////////////////////////////////////

////////////  RETURN SLIP ///////////////

 $returnQry ="SELECT * FROM sv_ticket_header INNER JOIN tb_return ON sv_ticket_header.log_ID = tb_return.log
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID  
									   WHERE gagamit.user_name = '".$_SESSION['username']."'
									   AND ticket_status.isWOClosed = 1  OR ticket_status.isWOOpen = 1";
$return = DB::getInstance()->query($returnQry);
$returnCount = 0;
if($return->rowCount()){
while ($row = $return->fetch(PDO::FETCH_ASSOC)){   $returnCount++;  }}

////////////////////////////////////////


////////////////////////////////////////

$ClosedQry ="SELECT * FROM sv_ticket_header 
                                       INNER JOIN tb_return ON sv_ticket_header.log_ID = tb_return.log
                                       INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email 
									   INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No 
									   INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID
									   WHERE gagamit.user_name = '".$_SESSION['username']."'
									   AND ticket_status.isWOClosed = 1
									   AND ticket_status.isWOOpen = 0 ";
$closed = DB::getInstance()->query($ClosedQry);
$ticketClosedNumber = 0;
if($closed->rowCount()){
while ($row = $closed->fetch(PDO::FETCH_ASSOC)){   $ticketClosedNumber++;  }}

////////////////////////////////////////

$ticketQry ="SELECT * 
							  FROM sv_ticket_header
				              INNER JOIN wo_ticket_details ON sv_ticket_header.log_ID = wo_ticket_details.log_No
                              INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
							  INNER JOIN ticket_status ON sv_ticket_header.log_ID =ticket_status.log_ID
                              INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email 
							  WHERE gagamit.user_name ='".$_SESSION['username']."'
							  AND gagamit.position = 1";
$tickets = DB::getInstance()->query($ticketQry);
$myticketcount = 0;
if($tickets->rowCount()){
while ($row = $tickets->fetch(PDO::FETCH_ASSOC)){   $myticketcount++;  }}

//////////////////////////////////////////









?>

<div id="navbar2">
             	<table id="navbar3">
                	<tr >

                        <th style="border:0px solid" width="80px"><a href="sv_myworkorder?status=open">
                        <img src="images/open.png" height="15px" width="15px">
                        Open(<?php echo $ticketOpenNumber; ?>)
                        </a></th>
                        <th style="border:0px solid" width="110px"><a href="sv_myworkorder?status=answered">
                        <img src="images/answered.png" height="15px" width="15px">
                        Answered(<?php echo $ticketAnsweredNumber; ?>)
                        </a></th>
                        <th style="border:0px solid" width="130px"><a href="sv_myworkorder">
                        <img src="images/myticket.png" height="15px" width="15px">
                        My Workorder(<?php echo (isset($myticketcount)) ? $myticketcount : "e"; ?>)
                        </a></th>
                        <th style="border:0px solid" width="110px"><a href="sv_myworkorder?status=overdue">
                        <img src="images/overdue.png" height="15px" width="15px">
                        Overdue(<?php echo $ticketOverdueNumber; ?>)
                        </a></th>
                        <th style="border:0px solid" width="160px"><a href="sv_myworkorder?status=closed">
                        <img src="images/closed.png" height="15px" width="15px">
                        Closed Workorder(<?php echo $ticketClosedNumber; ?>)
                        </a></th>
                        <th style="border:0px solid" width="120px"><a href="sv_myworkorder?status=pullout">
                        <img src="images/535129-print_512x512.png" height="15px" width="15px">
                        PullOut Slips(<?php echo (isset($pulloutCount)) ? $pulloutCount : "0"; ?>)
                        </a></th>
                        <th style="border:0px solid" width="130px"><a href="sv_myworkorder?status=returned">
                        <img src="images/535129-print_512x512.png" height="15px" width="15px">
                        Returned Slips(<?php echo (isset($returnCount)) ? $returnCount : "0"; ?>)
                        </a></th>

                    </tr>
                </table>  
            </div>