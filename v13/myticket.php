<?php

include "init.php";

$tabledata = "";
$searchme  = "";
$tkit = "";

if(isset($_SESSION['username'])){
		
		$usernamex = $_SESSION['username'];



        $searchme = (  isset($_POST['searchme']) )  ? $_POST['searchme'] : "" ;
        $status = (  isset($_GET['status'])  ) ? $_GET['status']  : " " ;

		switch($status){
		    	case 'Open':

                     if(isset($_POST['searchbutton'])){

                           switch($_POST['filterr']){

                                                      case 'TicketNo':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isClosed= 0
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                               INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed= 0 
																AND sv_ticket_header.sv_number like ?
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;


                                                      case 'Subject':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isClosed = 0
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 0 
																AND sv_ticket_details.subject like ?
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;

                                                      default:
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                               INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isClosed = 0
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                      break;
                                                    }

                     }else{

                           $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                          INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                           INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                           WHERE gagamit.user_name = ? 
						   AND sv_ticket_header.isClosed = 0
						   AND gagamit.position=0
						   ORDER BY sv_ticket_header.date_created DESC");
                           $result->execute(array($usernamex));
                            }
				break;

			case 'Overdue':

                     if(isset($_POST['searchbutton'])){

                           switch($_POST['filterr']){

                                                      case 'TicketNo':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                               INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isOverdue = 1
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                               INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isOverdue = 1 
																AND sv_ticket_header.sv_number like ?
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;


                                                      case 'Subject':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isOverdue = 1
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isOverdue = 1 
																AND sv_ticket_details.subject like ?
						                                        AND gagamit.position=0
																ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;

                                                      default:
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isOverdue = 1
						                                        AND gagamit.position=0
																ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                      break;
                                                    }

                     }else{

			             $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                         INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                         WHERE gagamit.user_name = ? 
						 AND sv_ticket_header.isOverdue = 1
						 AND gagamit.position=0
						 ORDER BY sv_ticket_header.date_created DESC");
                         $result->execute(array($usernamex));
                            }
				break;

		   case 'Answered':

                     if(isset($_POST['searchbutton'])){

                           switch($_POST['filterr']){

                                                      case 'TicketNo':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.response = 1
																AND gagamit.position=0
																AND sv_ticket_header.isClosed=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                               INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.response = 1 
																AND sv_ticket_header.isClosed=0
																AND sv_ticket_header.sv_number like ?
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;


                                                      case 'Subject':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                               INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.response = 1
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.response = 1 
																AND sv_ticket_header.isClosed=0
																AND sv_ticket_details.subject like ?
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;

                                                      default:
			           	                                        $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.response = 1
																AND sv_ticket_header.isClosed= 0
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                      break;
                                                    }

                     }else{

			           	 $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                         INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                         WHERE gagamit.user_name = ? 
						 AND sv_ticket_header.isClosed= 0
						 AND sv_ticket_header.response = 1
						 AND gagamit.position=0
						 ORDER BY sv_ticket_header.date_created DESC");
                         $result->execute(array($usernamex));
                            }
				break;

		   case 'ClosedTicket':

                     if(isset($_POST['searchbutton'])){

                           switch($_POST['filterr']){

                                                      case 'TicketNo':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isClosed = 1
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isClosed = 1
																AND sv_ticket_header.sv_number like ?
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;


                                                      case 'Subject':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isClosed = 1
						                                        AND gagamit.position=0
																ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.isClosed = 1 
																AND sv_ticket_details.subject like ?
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;

                                                      default:
			                                                    $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.isClosed = 1
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                      break;
                                                    }

                     }else{

			             $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                         INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                         WHERE gagamit.user_name = ? 
						 AND sv_ticket_header.isClosed = 1
						 AND gagamit.position = 0
						 ORDER BY sv_ticket_header.date_created DESC");
                         $result->execute(array($usernamex));
                            }
                break;

		default :

                     if(isset($_POST['searchbutton'])){

                           switch($_POST['filterr']){

                                                      case 'TicketNo':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ?
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_header.sv_number like ?
																AND gagamit.position=0 
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;


                                                      case 'Subject':
                                                           if ($searchme == ""){
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email 
                                                                WHERE gagamit.user_name = ?
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                               }else{
                                                                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? 
																AND sv_ticket_details.subject like ? 
																AND gagamit.position=0
						                                        ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex,'%'.$searchme.'%'));
                                                                 }
                                                      break;

                                                      default:
		                                                        $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                                                                INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                                                                WHERE gagamit.user_name = ? AND gagamit.position=0 ORDER BY sv_ticket_header.date_created DESC");
                                                                $result->execute(array($usernamex));
                                                      break;
                                                    }

                     }else{

		                $result = DB::getInstance()->prepare("SELECT DISTINCT * FROM sv_ticket_header
                        INNER JOIN sv_ticket_details ON sv_ticket_header.log_ID = sv_ticket_details.log_ID
                        INNER JOIN gagamit ON sv_ticket_header.ticketSenderEmail = gagamit.email
                        WHERE gagamit.user_name = ? AND gagamit.position=0 ORDER BY sv_ticket_header.date_created DESC");
                        $result->execute(array($usernamex));
                            }
				break;
		}

  //	}

//  $result = DB::getInstance()->query($sql);

    echo $loginSuccess = FALSE;
    if($result->rowCount()){

        while ($row = $result->fetch(PDO::FETCH_ASSOC)){

				$ticketID = $row['sv_number'];
				$datecreated = $row['date_created'];
				$from = $row['ticketSender'];
				$assignto = $row['assignto'];
				$subject = $row['subject'];
				$priority = $row['priority'];
				$stat = $row['status'];
                $log = $row['log_ID'];
		
              switch($status){
				  
				 case 'ClosedTicket': 
				    $tkit = "reopen.php?id=";
				 break;
	             case 'Open':
				    $tkit = "closedticket.php?id=";
				 break;
				 default:
				    $tkit = "csr_ticket.php?id=";
				 break; 
			   
			  }



				$tabledata .= '
				<tr>
                    	<th style="width:83px; height:25px;"><a href="'.$tkit.''.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$ticketID.'</a></th>
                        <th style="width:75px; height:25px;">'.$datecreated.'</th>
                        <th style="width:250px; height:25px;"><a href="'.$tkit.''.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$subject.'</a></th>
                        <th style="width:170px; height:25px;">'.$from.'</th>
                        <th style="width:70px; height:25px;">'.$priority.'</th>
                        <th style="width:140px; height:25px;">'.$assignto.'</th>

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
<title>Untitled Document</title>
<link type="text/css" rel="stylesheet" href="css/myticket.css" />
<link rel="stylesheet" type="text/css" href="css/menu2.css" />

</head>

<body style="background-color: #eeeeee;">
<div id="container">

	<div id="body">

      	<?php include "includes/header.php" ?>


   		<div id="content">

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
            <div id="ticket">

                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets">Assigned Tickets</th>
                    </tr>
           		</Table>

                <Table id="table2">
                  <tr>
                    	<th style="width:83px; height:25px;">Ticket</th>
                        <th style="width:75px; height:25px;">Date</th>
                        <th style="width:250px; height:25px;">Subject</th>
                        <th style="width:170px; height:25px;">From</th>
                        <th style="width:70px; height:25px;">Priority</th>
                        <th style="width:180px; height:25px;">Assigned To</th>
                    </tr>
            </Table>
          <div id="tickets">
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