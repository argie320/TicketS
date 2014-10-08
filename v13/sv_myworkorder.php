<?php
include("init.php");

//include("asset/DB.php");
$ticketURL="";
$stat="";
$tabledata = "";

if(isset($_SESSION['username'])){


include('includes/search_sv_myworkorder.php');

}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Supervisor Workorder</title>
<link type="text/css" rel="stylesheet" href="css/myticket.css" />
 <link rel="stylesheet" type="text/css" href="css/menu2.css" />
<!-- <link rel="stylesheet" type="text/css" href="css/menu.css" /> -->
</head>

<body>
<div id="container">
	<div id="body">

      	<?php include "includes/header.php" ?>

      
   		<div id="content">
        
        	<!-- START OF NAVBAR -->
        	<!--	<?php include("includes/nav.php"); ?> -->
                       <div class="cssmenu">

                <!-- <a href='dashboard.php' ><span>Dashboard</span></a> -->
                     <a href='dashboard.php' ><span>Dashboard</span></a>
                     <a href='myassignticket' ><span>Tickets</span></a>
                     <a href='sv_myworkorder.php'class="current" ><span>Work Order</span></a>
                 <!--   <a href='workorder.php'><span>Work Order</span></a> -->
            </div>
             <div class="cssmenusub">

            <!-- END OF NAVBAR --->

            <!-- START OF NAVBAR2 -->
  <?php include("includes/supervisorWorkOrderHeader.php"); ?>
            <!-- END OF NAVBAR2 -->

            <!-- START OF SEARCHBAR -->
            <div id="searchbar">
            	<form action="" method="POST">
                	<input type="text" name="search">
                    <select id="input" name="filterr">
                        <option>--Filter by--</option>
                        <option value="TicketNo">TicketNo</option>
                        <option value="SerialNo">SerialNo</option>
                        <option value="Subject">Subject</option>
                    </select>
                    <input type="submit" name="searchbutton" value="search" class="myButton">
             <!--       <input id="refresh" type="submit" name="refreshbutton" value="refresh">   -->
                </form>
                
            </div>
            
            <!-- END OF SEARCHBAR -->

            	
                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets">Assigned Workorder</th>
                    </tr>
           		</Table>

                <table id="table2">

                    <tr>
                    	<td style="border:1px solid" width="75px">Ticket No</td>
                        <td style="border:1px solid" width="75px">Date</td>
                        <td style="border:1px solid" width="260px">Subject</td>
                        <td style="border:1px solid" width="150px">From</td>
                        <td style="border:1px solid" width="70px">Priority</td>
                        <td style="border:1px solid" width="180px">Assign to</td>
                        
                        
                     <!--   
                        <th style="width:75px solid; height:25px;">Date</th>
                        <th style="width:250px solid; height:25px;">Subject</th>
                        <th style="width:170px solid; height:25px;">From</th>
                        <th style="width:70px solid; height:25px;">Priority</th>
                        <th style="width:180px solid; height:25px;">Assigned To</th> -->
                    </tr>

                </table>
                <div id="tickets">
                    <Table id ="table2">
 <tr>
                            <?php echo $tabledata; ?>
 </tr>
                    </Table>

                </div>
     

        <!-- end of content -->
        </div>
        
        </div>
    
    <!-- end of body -->    
    </div>
    <br>
    <?php include("includes/footer.php"); ?>

<!-- end of container -->
</div>
</body>
</html>