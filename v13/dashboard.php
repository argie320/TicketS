<?php

include("init.php");

//http://stackoverflow.com/questions/11722059/php-array-to-json-array-using-json-encode

// Non-consecutive number keys are OK for PHP
// but not for a JavaScript array
$array = array(
    'Supervisor' => array(
                        "date" => array(
                                                'close' => 1 ,
                                                'answered' => 6,
                                                'open' => 3,
                                                'overdue' => 5
                                                )
                         ),
    'Engineer' => array(
                        "date" => array(
                                            'close' => 1 ,
                                            'answered' => 6,
                                            'open' => 3,
                                            'overdue' => 5
        )
    ),
);

// array_values() removes the original keys and replaces
// with plain consecutive numbers
$out = array_values($array);


echo json_encode($out);
// [["Afghanistan",32,13],["Albania",32,12]]


?>

<!doctype html>
<html><head>
<meta charset="utf-8">
<title>Dash Board</title>
<link rel="stylesheet" type="text/css" href="css/dashboard.css" />

<link rel="stylesheet" type="text/css" href="css/menu.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/chart/highcharts.js"></script>
    <script type="text/javascript" src="js/chart/exporting.js"></script>

    <script type="text/javascript">

        $(function () {
            $('#graph').highcharts({
                title: {
                    text: 'Ticket Activity',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Source: www.steadfast.com',
                    x: -20
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'Count'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                tooltip: {
                    valueSuffix: ' ticket'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [{
                    name: 'Created',
                    data: [0, 30, 19, 4, 1, 2, 5, 6, 8, 1, 29, 7]
                },{
                    name: 'Open',
                    data: [7, 6, 9, 14, 18, 21, 25, 26, 23, 18, 13, 9]
                }, {
                    name: 'Answered',
                    data: [0, 1, 5, 11, 17, 22, 24, 24, 20, 14, 8, 2]
                }, {
                    name: 'Overdue',
                    data: [0, 0, 3, 8, 13, 17, 18, 17, 14, 9, 3, 1]
                }, {
                    name: 'Closed',
                    data: [3, 4, 5, 8, 11, 15, 17, 16, 14, 10, 6, 4]
                }]
            });
        });


    </script>




<!-- CSS CODE FOR TAB TAB TAB TAB-->
<link rel="stylesheet" type="text/css" href="css/tabtab.css"/>
<!-- END OF CSS CODE FOR TAB TAB TAB TAB-->
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
            <div id="navbar2">
            	<table id="navbar3">
                	<tr >
                    	<th style="border:0px solid" width="110px"><a href="dashboard.php">
                        <img src="images/dashboardicon.png" height="15px" width="15px">
                        Dashboard
                        </a></th>
                        <th style="border:0px solid" width="130px"><a href="staffdirectory.php">
                        <img src="images/staff.png" height="15px" width="15px">
                        Staff Directory
                        </a></th>
                        <th style="border:0px solid" width="110px"><a href="myprofile.php">
                        <img src="images/myprofile.png" height="15px" width="15px">
                        My Profile
                        </a></th>
                        
                    </tr>
                </table>
            </div>
            <!-- END OF NAVBAR2 -->
            <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets">Ticket Activity</th>
                    </tr>
           		</Table><br>
                <p id="label">Select the starting time and period for the system activity graph</p>
           		
                    	<form id="table2" style="margin-top:10px;">
                        	<label id="label">Report time frame:</label>
                            <input type="date" id="input">
                            <label id="label">period:</label>
                            <input type="date" id="input">
                            <input type="submit" id="submit" value="refresh" class="refresh" onclick="">
                        </form>
                    	<br>
                 <p id="label">
                 	
                    <div id="graph" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                 
                 </p>
                 
                 <br>
        </div><br><br>
        <p id="label2">Statistics</p>
        <p id="label" style="margin-top:10px;">
        Statistics of tickets organized by department, help topic, and staff.</p><br>
        <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets">
                        <a href="dashboard.php" style="margin-left:15px">Department </a>
                        <a href="dashboard.php" style="margin-left:15px">Topics </a>
                        <a href="dashboard.php" style="margin-left:15px">Staffs</a></th>
                        
                    </tr>
           		</Table>
                <table id="table">
                	<tr>
                    	<td style="border:0px solid" width="150px">Help Topic</td>
                        <td style="border:0px solid" width="100px">Opened</td>
                        <td style="border:0px solid" width="100px">Assigned</td>
                        <td style="border:0px solid" width="100px">Overdue</td>
                        <td style="border:0px solid" width="100px">Closed</td>
                        <td style="border:0px solid" width="100px">Reopened</td>
                        <td style="border:0px solid" width="108px">Service Time</td>
                        <td style="border:0px solid" width="100px">Response Time</td>
                    </tr>
                    	
                    <tr>
                    	<td>Billing</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td>Request for Payment</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td>Support</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <!-- START OF TAB TAB TAB TAB! -->
<div class="tabs">
   <!-- TAB 1 -->
   <div class="tab">
       <input type="radio" id="tab-1" name="tab-group-1" checked>
       <label for="tab-1">Customer</label>
       
       <div class="content">
           <table id="table">
                	<tr>
                    	<td style="border:0px solid" width="170px">Customer Name</td>
                        <td style="border:0px solid" width="100px">Opened</td>
                        <td style="border:0px solid" width="170px">Assigned Engr</td>
                        <td style="border:0px solid" width="100px">Overdue</td>
                        <td style="border:0px solid" width="100px">Closed</td>
                        <td style="border:0px solid" width="108px">Service Time</td>
                        <td style="border:0px solid" width="100px">Response Time</td>
                    </tr>
                    	
                    <tr>
                    	<td>Jose Balibagtuta</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td>Aljur Abrelata</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td>Benito Benigno</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                
       </div> 
   </div>
    <!-- END OF TAB 1 -->
    
    <!-- TAB 2 -->
   <div class="tab">
       <input type="radio" id="tab-2" name="tab-group-1">
       <label for="tab-2">Engineer</label>
       
       <div class="content">
           <table id="table">
                	<tr>
                    	<td style="border:0px solid" width="150px">Engineer	Name</td>
                        <td style="border:0px solid" width="150px">Company	</td>
                        <td style="border:0px solid" width="100px">Opened</td>
                        <td style="border:0px solid" width="100px">Assigned</td>
                        <td style="border:0px solid" width="100px">Overdue</td>
                        <td style="border:0px solid" width="100px">Closed</td>
                        <td style="border:0px solid" width="108px">Service Time</td>
                        <td style="border:0px solid" width="100px">Response Time</td>
                    </tr>
                    	
                    <tr>
                    	<td>[insert engr name]</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td>[insert engr name]</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td>[insert engr name]</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
       </div> 
   </div>
    <!-- END OF TAB 2 -->
    
    <!-- TAB 3 -->
    <div class="tab">
       <input type="radio" id="tab-3" name="tab-group-1">
       <label for="tab-3">Date</label>
     
       <div class="content">
           <table id="table">
                	<tr>
                    	<td style="border:0px solid" width="150px">Date	</td>
                        <td style="border:0px solid" width="150px">Company	</td>
                        <td style="border:0px solid" width="100px">Opened</td>
                        <td style="border:0px solid" width="100px">Assigned</td>
                        <td style="border:0px solid" width="100px">Overdue</td>
                        <td style="border:0px solid" width="100px">Closed</td>
                        <td style="border:0px solid" width="108px">Service Time</td>
                        <td style="border:0px solid" width="100px">Response Time</td>
                    </tr>
                    	
                    <tr>
                    	<td>June 25, 2014</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td>June 26, 2014</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td>June 27, 2014</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
       </div> 
   </div>
    <!-- END OF TAB 3 -->
    
    <!-- TAB 4 -->
    <div class="tab">
       <input type="radio" id="tab-4" name="tab-group-1">
       <label for="tab-4">Ticket Summary</label>
     
       <div class="content">
           <table id="table">
                	<tr>
                        <td style="border:0px solid" width="220px">Company	Name</td>
                        <td style="border:0px solid" width="100px">Opened</td>
                        <td style="border:0px solid" width="100px">Assigned</td>
                        <td style="border:0px solid" width="100px">Overdue</td>
                        <td style="border:0px solid" width="100px">Closed</td>
                        <td style="border:0px solid" width="108px">Service Time</td>
                        <td style="border:0px solid" width="100px">Response Time</td>
                    </tr>
                    	
                    <tr>
                        <td>SteadFast Solutions Inc.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Jump Solutions Inc.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Forefront Innovative Solutions Inc.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
       </div> 
   </div>
    <!-- END OF TAB 4 -->
</div>
      <!-- END OF TAB TAB TAB TAB ---->         
        
        
    </div><center><font face="century gothic" size="-1"<p>  AtomIT Solutions &copy;  All rights reserved 2014.mpz</p></center>
</div>
</body>



<script type="text/javascript">


	function ServiceTicketJSON(){
		
		this.data = null;
		
		this.getData = function(data){
			
			if(data != null){
				switch(data){
				}
			}
			
		}
		
	}

    $(document).ready(function(e) {
        $('.refresh').click(function(){
			
			console.log('OK');
			$.getJSON("dashboard.php" , function(data){
				
				console.log("database");
            	for (var i=0, len=data.length; i < len; i++) {
                	console.log(data[i]);
            	}

        });
			
			return false;
			
		});
    });

    function getData(){
        $.getJSON("dashboard.php" , function(data){


            for (var i=0, len=data.length; i < len; i++) {
                console.log(data[i]);
            }

        });
    }

</script>


</html>