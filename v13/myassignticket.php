<?php

include "init.php";

$tabledata = "";
$searchme  = "";


if(isset($_SESSION['username'])){

    $usernamex = $_SESSION['username'];



    $searchme = (  isset($_POST['searchme']) )  ? $_POST['searchme'] : "" ;
    $stat = (  isset($_GET['status'])  ) ? $_GET['status']  : " " ;
	
  include "includes/search_myassignticket.php";
    


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
            $isAssign = $row['isAssign'];
            $log = $row['log_ID'];
			$closed = $row['isClosed'];

                        if($row['position'] != 1){
                Redirect::to(1, null);
            }else{
                //ignore
            }

            $isWorkOrderCreated = "None";

            if(is_numeric($isAssign)){
                switch($isAssign){
                    case 0:
					      ($closed==1)?$isWorkOrderCreated="CLOSED":
                        $isWorkOrderCreated = '<a href="createworkorder.php?id='.$ticketID.'&&log='.$log.'" style="color:#0099FF;">NO</a>';
                        break;
                    case 1:
					($closed==1)?$isWorkOrderCreated="CLOSED":
                        $isWorkOrderCreated = "YES" ;
                        break;
                    default:
                        //$isWorkOrderCreated = false;
                        break;
                }
            }



            $tabledata .= '
				<tr>
                    	<th style="word-break:break-all; width:83px; height:25px;"><a href="csr_ticket.php?id='.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$ticketID.'</a></th>
                        <th style="word-break:break-all; width:75px; height:25px;">'.$datecreated.'</th>
                        <th style="word-break:break-all; width:250px; height:25px;"><a href="csr_ticket.php?id='.$ticketID.'&&log='.$log.'" style="color:#0099FF;">'.$subject.'</a></th>
                        <th style="word-break:break-all; width:170px; height:25px;">'.$from.'</th>
                        <th style="word-break:break-all; width:70px; height:25px;">'.$priority.'</th>
                        <th style="word-break:break-all; width:170px; height:25px;">'.$isWorkOrderCreated.'</th>

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
    <title>Supervisor Service Ticket</title>
<link type="text/css" rel="stylesheet" href="css/style.css" />
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

                <!-- <a href='dashboard.php' ><span>Dashboard</span></a> -->
                     <a href='dashboard.php' ><span>Dashboard</span></a>
                     <a href='myassignticket.php' class="current"><span>Tickets</span></a>
                     <a href='sv_myworkorder.php'><span>Work Order</span></a>
                 <!--   <a href='workorder.php'><span>Work Order</span></a> -->


            </div>
            <div class="cssmenusub">

            <!-- END OF NAVBAR --->

            <!-- START OF NAVBAR2 -->

    <?php  include "includes/Access.php"; ?>
            <!-- END OF NAVBAR2 -->
            <!-- START OF SEARCHBAR -->
            <div id="searchbar">
       <!--     <h2 style="float:left;line-height:30px">My ticket</h2> -->
                <form action="" method="POST">

                    <input type="text" name="searchme">
                    <select id="input" name="filterr">
                        <option>--Filter by--</option>
                        <option value="TicketNo">TicketNo</option>
                        <option value="SerialNo">SerialNo</option>
                        <option value="Subject">Subject</option>
                    </select>
                    <input type="submit" name="searchbutton" value="Search" class="myButton">
               <!--     <input id="refresh" type="submit" name="refreshbutton" value="Refresh" class="myButton"> -->
                  </form>

            </div>

            <div id="clear"></div>

            <!-- END OF SEARCHBAR -->
            <div id="ticket">

                <Table style="margin-left:auto; margin-right:auto;">
                    <tr>
                        <th id="opentickets">Assigned Tickets</th>
                    </tr>
                </Table>

                <Table style id="table2">

                  <tr>
                    	<td style="border:1px solid" width="83px">Ticket No</td>
                        <td style="border:1px solid" width="75px">Date</td>
                        <td style="border:1px solid" width="250px">Subject</td>
                        <td style="border:1px solid" width="170px">From</td>
                        <td style="border:1px solid" width="70px">Priority</td>
                        <td style="border:1px solid" width="170px">WorkOrder Created</td>
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

      </div>        <!-- end of content -->


     <!-- end of body -->
      </div>
    <!-- end of container -->
    <br/>
           </div>
              <br>
<span>
   							<?php include("includes/footer.php"); ?>
</span>
</div>

</body>
</html>