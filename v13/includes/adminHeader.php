<?php
$ticketstatusCounter =	   "SELECT * FROM sv_ticket_header INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email";


$statusresult = DB::getInstance()->query($ticketstatusCounter);


        		$ticketOpenNumber = 0;
				$ticketOverdueNumber = 0;
				$ticketClosedNumber = 0;
				$ticketAnsweredNumber = 0;
				$myticketcount = 0;


			if($statusresult->rowCount()){



				while ($row = $statusresult->fetch(PDO::FETCH_ASSOC)){

					$openTicket = $row['isClosed'];
					$ticketOverdue = $row['isOverdue'];
					$ticketResponse = $row['response'];

					($openTicket == "1") ? $ticketClosedNumber++ : "error";
					($openTicket == "0") ? $ticketOpenNumber++ : "error";
					($ticketResponse == 1) ? $ticketAnsweredNumber++ : "error";
					($ticketOverdue == 1) ? $ticketOverdueNumber++ : "error";


					$myticketcount++;

				}
			}

?>

<div id="navbar2">
            	<table id="navbar3">
                	<tr >
                    	<th style="border:0px solid" width="100px"><a href="myadmin?status=Open">
                        <img src="images/open.png" height="15px" width="15px">
                        All Open(<?php echo $ticketOpenNumber; ?>)
                        </a></th>
                        <th style="border:0px solid" width="130px"><a href="myadmin?status=Answered">
                        <img src="images/answered.png" height="15px" width="15px">
                        All Answered(<?php echo $ticketAnsweredNumber; ?>)
                        </a></th>
                        <th style="border:0px solid" width="110px"><a href="myadmin">
                        <img src="images/myticket.png" height="15px" width="15px">
                        All Tickets(<?php echo (isset($myticketcount)) ? $myticketcount : "e"; ?>)
                        </a></th>
                        <th style="border:0px solid" width="120px"><a href="myadmin?status=Overdue">
                        <img src="images/overdue.png" height="15px" width="15px">
                        All Overdue(<?php echo $ticketOverdueNumber; ?>)
                        </a></th>
                        <th style="border:0px solid" width="150px"><a href="myadmin?status=ClosedTicket">
                        <img src="images/closed.png" width="15px" height="15px">
                        All Closed Tickets(<?php echo $ticketClosedNumber; ?>)
                        </a></th>

                    </tr>
                </table>
            </div>