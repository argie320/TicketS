<?php 

include("functions/loggedIn.php");
include("asset/DB.php");

$tabledata = "";

$database = new DB();

if(isset($_SESSION['username'])){
	
	$sql =	   "SELECT * FROM sv_ticket_header
INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email
WHERE gagamit.user_name =  '".$_SESSION['username']."'";
	
	if(isset($_GET['status'])){
		
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
		
	}
	
	$result = $database->dbhandler->query($sql);

    echo $loginSuccess = FALSE;
    if($result->rowCount()){

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){

            $ticketID = $row['sv_number'];
            $datecreated = $row['date_created'];
            $from = $row['ticketSender'];
            $assignto = $row['assignto'];
            $subject = $row['subject'];
            $priority = $row['priority'];
            $status = $row['status'];




            $tabledata .= '
				<tr>
                    	<th style="width:85px; height:25px;"><a href="ticket.php?id='.$ticketID.'" style="color:#0099FF;">'.$ticketID.'</a></th>
                        <th style="width:85px; height:25px;">'.$datecreated.'</th>
                        <th style=" height:25px;"><a href="ticket.php?id='.$ticketID.'" style="color:#0099FF;">'.$subject.'</a></th>
                        <th style="width:195px; height:25px;">'.$from.'</th>
                        <th style="width:72px; height:25px;">'.$priority.'</th>
                        <th style="width:140px; height:25px;">'.$assignto.'</th>
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
<title>Untitled Document</title>
<link type="text/css" rel="stylesheet" href="css/myticket.css" />

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
            	<?php include("includes/ticket_navigation.php"); ?>
            <!-- END OF NAVBAR2 -->
            
            <!-- START OF SEARCHBAR -->
            <div id="searchbar">
            	<form action="" method="POST">
                	<input type="text" name="search">
                    <input type="submit" name="searchbutton" value="search">
                    <input id="refresh" type="submit" name="refreshbutton" value="refresh">
                </form>
                
            </div>
            
            <!-- END OF SEARCHBAR -->
            <div id="tickets">
            	
                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets">Assigned Tickets</th>
                    </tr>
           		</Table>
            	
                <table id="table">
                	
                    <tr>
                    	<th style="width:85px; height:25px;">Ticket</th>
                        <th style="width:85px; height:25px;">Date</th>
                        <th style="width:300px; height:25px;">Subject</th>
                        <th style="width:195px; height:25px;">From</th>
                        <th style="width:72px; height:25px;">Priority</th>
                        <th style="width:140px; height:25px;">Assigned To</th>
                    </tr>
                    <tr>
                    	<?php echo $tabledata; ?>
                    </tr>
                </table>
            </div>
        
        <!-- end of content -->
        </div>
        
        
    
    <!-- end of body -->    
    </div>
    
    <?php include("includes/footer.php"); ?>

<!-- end of container -->
</div>
</body>
</html>