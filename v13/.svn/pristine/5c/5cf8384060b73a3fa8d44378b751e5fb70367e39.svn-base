<?php 
$ticketstatusCounter =	   "SELECT * FROM sv_ticket_header INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
WHERE gagamit.user_name =  '".$_SESSION['username']."'";

			
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