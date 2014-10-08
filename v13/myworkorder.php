<?php
include "init.php";


$tabledata = "";
$result="";
$searchx="";
$stat="";
if(isset($_SESSION['username'])){

	
///////////////////////////////////// DATA ////////////////////////////////////////////////////

include "includes/search_myworkorder.php";

/////////////////////////////////////////////////////////////////////////////////

}

?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>My Workorder</title>
<link type="text/css" rel="stylesheet" href="css/myticket.css" />

<link rel="stylesheet" type="text/css" href="css/menu2.css" />
</head>

<body>
<div id="container">
	<div id="body">

 	<?php include "includes/header.php" ?>

   		<div id="content">

        	<!-- START OF NAVBAR -->
        	<!--	<?php include("includes/nav.php"); ?> -->
           <div class="cssmenu">
            	
   					<a href='dashboard.php'><span>Dashboard</span></a>
   					<a href='myworkorder.php' class="current"><span>Work Order</span></a>
               
            </div>
            <!-- END OF NAVBAR --->

            <!-- START OF NAVBAR2 -->
              <!--	<?php include("includes/ticket_navigation.php"); ?>-->


        <?php include "includes/Access.php"; ?>

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
                    <input type="submit" name="searchbutton" value="search" class="myButton">
                
                </form>
                
            </div>
            
            <!-- END OF SEARCHBAR -->
            <div id="tickets">
            	
                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets">Assigned Workorders</th>
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
<br>
    
    <?php include("includes/footer.php"); ?>

<!-- end of container -->
</div>
</body>
</html>