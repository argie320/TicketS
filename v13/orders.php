<?php
/**
 * Created by PhpStorm.
 * User: AndroVonryan
 * Date: 9/5/14
 * Time: 10:32 AM
 */

include "init.php";

$tabledata = "";
$searchme  = "";


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
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Open'
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Open' AND sv_ticket_header.sv_number like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;


                    case 'Subject':
                        if ($searchme == ""){
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Open'
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Open' AND sv_ticket_details.subject like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;

                    default:
                        $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Open'
						                                        ORDER BY sv_ticket_header.date_created DESC");
                        $result->execute(array($usernamex));
                        break;
                }

            }else{

                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                           INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                           INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                           WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Open'
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
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1 AND sv_ticket_header.sv_number like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;


                    case 'Subject':
                        if ($searchme == ""){
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1 AND sv_ticket_details.subject like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;

                    default:
                        $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1
						                                        ORDER BY sv_ticket_header.date_created DESC");
                        $result->execute(array($usernamex));
                        break;
                }

            }else{

                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                         WHERE gagamit.user_name = ? AND sv_ticket_header.isOverdue = 1
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
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.response = 1
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.response = 1 AND sv_ticket_header.sv_number like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;


                    case 'Subject':
                        if ($searchme == ""){
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.response = 1
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.response = 1 AND sv_ticket_details.subject like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;

                    default:
                        $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.response = 1
						                                        ORDER BY sv_ticket_header.date_created DESC");
                        $result->execute(array($usernamex));
                        break;
                }

            }else{

                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                         WHERE gagamit.user_name = ? AND sv_ticket_header.response = 1
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
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Closed'
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Closed' AND sv_ticket_header.sv_number like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;


                    case 'Subject':
                        if ($searchme == ""){
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Closed'
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Closed' AND sv_ticket_details.subject like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;

                    default:
                        $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Closed'
						                                        ORDER BY sv_ticket_header.date_created DESC");
                        $result->execute(array($usernamex));
                        break;
                }

            }else{

                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                         INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                         INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                         WHERE gagamit.user_name = ? AND sv_ticket_header.status = 'Closed'
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
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_header.sv_number like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;


                    case 'Subject':
                        if ($searchme == ""){
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex));
                        }else{
                            $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? AND sv_ticket_details.subject like ?
						                                        ORDER BY sv_ticket_header.date_created DESC");
                            $result->execute(array($usernamex,'%'.$searchme.'%'));
                        }
                        break;

                    default:
                        $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                                                                INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                                                                INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                                                                WHERE gagamit.user_name = ? ORDER BY sv_ticket_header.date_created DESC");
                        $result->execute(array($usernamex));
                        break;
                }

            }else{

                $result = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
                        INNER JOIN sv_ticket_details ON sv_ticket_header.sv_number = sv_ticket_details.sv_number
                        INNER JOIN gagamit ON sv_ticket_header.assignto = gagamit.email OR gagamit.position=0
                        WHERE gagamit.user_name = ? ORDER BY sv_ticket_header.date_created DESC");
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
            $status = $row['status'];




            $tabledata .= '
				<tr>
                    	<th style="width:83px; height:25px;"><a href="ticket.php?id='.$ticketID.'" style="color:#0099FF;">'.$ticketID.'</a></th>
                        <th style="width:75px; height:25px;">'.$datecreated.'</th>
                        <th style="width:250px; height:25px;"><a href="ticket.php?id='.$ticketID.'" style="color:#0099FF;">'.$subject.'</a></th>
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
    <link rel="stylesheet" type="text/css" href="css/menu.css" />

</head>

<body style="background-color: #eeeeee;">
<div id="container">

    <div id="body">

        <?php include "includes/header.php" ?>


        <div id="content">

            <!-- START OF NAVBAR -->
            <!--   <?php include("includes/nav.php"); ?>  -->
            <div id="cssmenu">
                <ul>
                    <li><a href='dashboard.php'><span>Dashboard</span></a></li>
                    <li><a href='myticket'><span>Tickets</span></a></li>
                    <li><a href='workorder.php'><span>Work Order</span></a></li>

                </ul>
            </div>
            <!-- END OF NAVBAR --->

            <!-- START OF NAVBAR2 -->
            <?php include("includes/ticket_navigation.php"); ?>
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
                    <input id="refresh" type="submit" name="refreshbutton" value="Refresh" class="myButton">
                </form>

            </div>

            <!-- END OF SEARCHBAR -->
            <div id="tickets">

                <Table style="margin-left:auto; margin-right:auto;">
                    <tr>
                        <th id="opentickets">Assigned Tickets</th>
                    </tr>
                </Table>

                <Table style id="table" "margin-left:8px; margin-right:10px;">
                <tr>
                    <th style="width:83px; height:25px;">Ticket</th>
                    <th style="width:75px; height:25px;">Date</th>
                    <th style="width:250px; height:25px;">Subject</th>
                    <th style="width:170px; height:25px;">From</th>
                    <th style="width:70px; height:25px;">Priority</th>
                    <th style="width:180px; height:25px;">Assigned To</th>
                </tr>
                </Table>
                <div id="ticket">
                    <Table id ="table">
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

    <!-- end of container -->
    <br/>
<span>
   							<?php include("includes/footer.php"); ?>
</span>
</div>
</body>
</html>