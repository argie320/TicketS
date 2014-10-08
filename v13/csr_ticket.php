<?php
include "init.php";


    $itemDetails = "";
						
	$source = "";
	$department = "";
	$HelpTopic = "";
	$priority = "";
	$SLAPlan = "";
	$duedate  = "";
	$duetime = "";
	$assignto ="";
	$company = "";
	$Reference = "";
	
	$item = ""; 
	$Unit_Brand = ""; 
	$Unit_Model = "";  
	$Machine_Serial_No = ""; 
	$Part_No_Quantity = ""; 
	$Quantity = ""; 
	$Warranty = "";
	$sv_number = "";
						
	$subject = "";
	$issue  = "";
	$details = "";
	$remarks  = "";

    /**
    * *Start of Display the list of engineer
    */
    $attachment = "";
    $personInfo = new PersonInfo();
    $engineerInfo = $personInfo->getListOfEngineer();
    $person = '';
	$personPosition = "";
    foreach($engineerInfo as $key => $list){
        $person = '<option value="'.$list['Email'].'"> '.$list['FullName'].' , '.$list['Email'].' </option>';
    }


$current_sv_number = "";


if( isset($_SESSION['username'])){



if(isset($_GET['id']) && isset($_GET['log'])){


	$id =  preg_replace('#[^0-9]#i', '' , stripslashes( strip_tags( trim(  $_GET['id'] ) )));
    $log =  preg_replace('#[^0-9]#i', '' , stripslashes( strip_tags( trim(  $_GET['log'] ) )));

    $current_sv_number = $id;
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,  
                                                      DB_DATABASE) or trigger_error('Error'); 


	$sql = "SELECT  DISTINCT *
FROM tbcustomer INNER JOIN sv_ticket_header ON tbcustomer.sv_number = sv_ticket_header.sv_number 
INNER JOIN sv_ticket_item_details ON tbcustomer.sv_number = sv_ticket_item_details.sv_number 
INNER JOIN sv_ticket_details ON tbcustomer.sv_number = sv_ticket_details.sv_number 
WHERE sv_ticket_header.sv_number = ".$id." AND sv_ticket_header.log_ID=".$log."";
	
	
	$sql_load_attachment = "SELECT * FROM `sv_ticket_details_attachment` WHERE sv_number =  ".$id."";


	
	
	$result = mysqli_query($dbc, $sql);
	
	
	//Important Information
	if($result->num_rows){
            
         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

	      $Client = new Customer(
                 $row['customer_snum'],
                 $row['customer_name'],
                 $row['customer_email'],
                 $row['customer_cnum'],
                 $row['customer_fnum'],
                 $row['customer_baddr'],
                 $row['customer_contact']
             );
				
						
				$source  = $row['source'];
				$department = $row['department'];
				$HelpTopic = $row['help_topic'];
				$priority = $row['priority'];
				$SLAPlan = $row['slaplan'];
				$duedate = $row['duedate'];
				$duetime= $row['duetime'];
				$assignto = $row['assignto'];
				$company = $row['company'];
				$Reference = $row['reference'];
			
				$ticketTimeCreated = $row['time_created'];
				$ticketDateCreated = $row['date_created'];
				
			
			    $item = $row['item'];  
	  	        $Unit_Brand = $row['Unit_Brand'];  
				$Unit_Model = $row['Unit_Model'];  
				$Machine_Serial_No = $row['Machine_Serial_No'];   
				$Part_No_Quantity = $row['Part_No_Quantity'];   
				$Quantity = $row['Quantity'];   
				$Warranty = $row['Warranty'];   
				$sv_number = $row['sv_number']; 
				
								
				$itemDetails = '
		<tr>

                        <td width="160px" id="tdtyle">
                        	<input type="text" id="unitbrand" value="'.$Unit_Brand.'" readonly>
                        </td>
                        <Td width="160px" id="tdtyle">
                        	<input type="text" id="unitmodel" value="'.$Unit_Model.'" readonly>
                        </Td>
                        <Td width="130px" id="tdtyle">
                        	<input type="text" id="serial" value="'.$Machine_Serial_No.'" readonly>
                        </Td>
                        <td width="110px" id="tdtyle">
                        	<input type="text" id="partno" value="'.$Part_No_Quantity.'" readonly>
                        </td>

                        <td width="150px" id="tdtyle" >
                        	<select name="warranty">
                                <option value='.$Warranty.'>'.$Warranty.'</option>
                            </select>
                        </td>
                    </tr>';
	
  
				
				
			}  
			
			   
	}
	 $qry2 = DB::getInstance()->prepare("SELECT * FROM sv_ticket_details WHERE sv_number = ? AND log_ID = ?");
$qry2->execute(array($id,$log));
	if($qry2->rowCount()){
         while ($row = $qry2->fetch(PDO::FETCH_ASSOC)) { 
		         $subject = $row['subject'];
				 $issue = $row['issue'];
				 $remarks = $row['remarks'];
				}}else{ echo "No Record"; }
	      
	
	
	//Load Attachment and generate
	$result_for_attachment = mysqli_query($dbc, $sql_load_attachment);
	if($result_for_attachment->num_rows){
            
         while ($row = $result_for_attachment->fetch_array(MYSQLI_ASSOC)) {

				$attachment .= '<li><a href="attachment/'.$row['sv_number'].'/'.$row['uniqid'].'" target="_blank">'.$row['attachment'].'</a></li>';
				
		 }
	}
	
	//encrypt sv_number 
	$current_sv_number = $id;
}

/*******************************************************************************************************
 * ******************************************************************************************************
 *
 * Display all ticket comment
 *
 *
 ********************************************************************************************************
 *******************************************************************************************************/
include_once('classes/Ticketreplay.php');

$comments = new Ticketreplay($current_sv_number, $_SESSION['username']);
$displayComment = $comments->viewTicketReplay();
//print_r($displayComment);

$ListOfComment = "";

if($displayComment==0){
    //echo "No comment yet!";
}else if($displayComment== -1){
    echo "Cant find service number!";
}else{

    foreach($displayComment as $key => $list){


        $ListOfComment .= '<div id="ticket_summary" style="border:solid 1px #999999;width:95%;margin:20px auto;">

                <table id="table2" style="margin-top:15px">
                	<tr>
                    	<td>
                        	<h4 style="text-transform:Uppercase">Replied By: '.$list['sender'].'      </h4>
                        	<p> Date: '.$list['DatePosted'].'</p>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label" style="font-weight:bold">
                            	Message:
                            </label>
                            <label id="label">'.$list['message'].' </label>
                        </td>
                    </tr>

                </table>

                </div>';

    }
}





if(isset($_POST['postComment'])){
	
	

    $ticketNumber = $_POST['ticketNo'];
	$tlog = $_POST['log'];
    $username = $_SESSION['username'];
    $MessageReplay = htmlspecialchars( $_POST['commentbox'],  ENT_QUOTES );
	
	
	$chkPosition = DB::getInstance()->prepare("SELECT * from gagamit INNER JOIN sv_ticket_header
	                                        ON gagamit.email = sv_ticket_header.assignto
											INNER JOIN ticket_status ON sv_ticket_header.log_ID = ticket_status.log_ID
										    where user_name=?");
	$chkPosition->execute(array($username));
	  if($chkPosition->rowCount()){
		  while($row=$chkPosition->fetch(PDO::FETCH_ASSOC)){
			  
			$position=$row['position']; 
			$response = $row['isAnswered'];

			}  
	
	      
         if($position==1 && $response==0){
		  
          $result = DB::getInstance()->prepare("UPDATE sv_ticket_header SET response = 1 WHERE log_ID = ?");
		  $result->execute(array($tlog));
		  
		  $result1 = DB::getInstance()->prepare("UPDATE ticket_status SET isAnswered = 1,dateAnswered=now() WHERE log_ID = ?");
		  $result1->execute(array($tlog));
		 }

		  } 
		 
		 
    if(isset($MessageReplay)){

        $ticketReplay = new Ticketreplay( $ticketNumber ,  $username);
        $status =  $ticketReplay->postComment( $ticketNumber , $MessageReplay, $username);



        if(isset($status)){

            switch($status){
                case 1:
                    Redirect::to( 5, 'csr_ticket?id='.$ticketNumber.'&&log='.$tlog.'' );
                    break;
                case 0:
                    echo "Adding comment was failed !";
                    break;
                case -1:
                    echo "Please Enter your message !";
                    break;
                case -2:
                    echo "Cant add the comment. ticket number does not match!";
                    break;
            }
        }

    }else{
        echo "Please fill up Comment box";
    }

}

}else{
    //If username is not set
    Redirect::to(1 , null);
}

?>








<!doctype html>
<html>
<head>
	
    <meta charset="utf-8">
	<title>New Ticket - Service Ticket</title>
	<link type="text/css" rel="stylesheet" href="css/newticket.css" />
    <link type="text/css" rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/menu2.css" />
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function(e) {
            $('.assignto').change(function(){
				$('.assignToLabel').text($(this).find('option:selected').text());
			});
			$('#submitassign').click(function(){
				if($('.assignto').val()!=0&&$('.assignToLabel').text()!="Enginner"||$('.assignToLabel').text()!=""){
					$('#assignform').submit(function(){return true});
				}else{
					$('#assignform').submit(function(){return false});
				}
				
			});
			$('#assignreset').click(function(){
				$('textarea').val('');
				$('.assignToLabel').html('Engineer');
				$('.assignto').find('option:selected');
			});
        });
	</script>
    
</head>

<body>
<div id="container">
	<div id="body">
   	 <?php include "includes/header.php"; ?>
     

     <div id="content">


             <!-- START OF NAVHeader-->

            	<?php
                $CheckPosition = DB::getInstance()->prepare("SELECT user_name, position FROM gagamit WHERE user_name = ?");
                $CheckPosition->execute(array($_SESSION['username']));

                if($CheckPosition->rowCount()){
                    while($r = $CheckPosition->fetch()){
                        $personPosition = $r['position'];
                        if(is_numeric($personPosition)){
                            switch($personPosition){
                                case 0:
                                    include("includes/CSRHeader.php");
                                    break;
                                case 1:
                                    include "includes/supervisorHeader.php";
                                    break;
                                default:
                                    Redirect::to(0, null);
                                    break;
                            }
                        }
                    }
                }
                ?>
            <!-- END OF NAVBAR2 -->
     <div class = cssmenusub>
     		
<div id="content">
            <div id="errorMessage">
            <h1></h1>
            </div>

          
           <!-- START OF NEW TICKET AND USER INFORMATION!! -->
            <div id="tickets">
            	<table style="margin-left:auto; margin-right:auto;">
                	<br />
            		<tr>
                    	<th id="opentickets" style="text-align:center">New Ticket</th>
                    </tr>
                    <tr>
                    	<th id="opentickets2">Customer Information</th>
                    </tr>
           		</table>
                
        
                
                
                <table id="table" style="margin-top:1px">
                
                
                
                
                
                
                
                
                
                
                <tr>
                	<td>
                    	<label id="label">Customer Code:</label>
                    </td>
                    <td>
                    	<p><?php echo $Client->custcode; ?></p>
                    </td>
                    <td>
                    	<label id="label" style="margin-left:40px">Address</label>
                    </td>
                    <td>
                    	<P><?php echo $Client->Address; ?></P>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<label id="label">Customer Name:</label>
                    </td>
                    <td>
                    	<p><?php echo $Client->ContactName; ?></p>
                    </td>
                    <td>
                    	<label id="label" style="margin-left:40px">Contact Person:</label>
                    </td>
                    <td>
                    	<p><?php echo $Client->ContactPerson; ?></p>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<label id="label">Email Address:</label>
                    </td> 
                	<td>
                    	<p><?php echo $Client->EmailAddress; ?></p>
                   	</td>
                </tr><br> 
                	<td>
                    	<label id="label">Contact Number:</label>
                    </td>
                	<td>
                    	<p><?php echo $Client->ContactNumber; ?></p>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<label id="label">Fax No:</label>
                    </td>
                    <td>
                    	<p><?php echo $Client->FaxNo; ?></p>
                    </td>
                </tr>
                </table><br>
                <!-- END OF NEW TICKET AND USER INFORMATION!! -->
                
                <!-- START OF TICKET INFORMATION & OPTION!! -->
                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets2">Ticket and Information Options</th>
                    </tr>
                </Table>
                
                
                <table id="table2" style="margin-top:20px">
                	<tr>
                    	<td>
                        	<label id="label">Ticket Source:</label>
                        </td>
                        <td>
                        	<p><?php echo  $source; ?></p>
                        </td>
                        
                    	<td>
                    		<label id="label" style="margin-left:40px;">Company:</label>
                    	</td>
                    	<td>
                    		<p><?php echo $company; ?></p>
                    	</td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Department:</label>
                        </td>
                        <td>
                        	<P><?php echo $department; ?></P>
                        </td>
                        <td>
                   			<label id="label" style="margin-left:40px;">Reference</label>
                   		</td>
                		<td>
                        	<p><?php echo $Reference; ?></p>
                    	</td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Help Topic:</label>
                        </td>
                        <td>
                        	<p><?php echo $HelpTopic; ?></p>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Priority</label>
                        </td>
                        <td>
                        	<p><?php echo $priority; ?></p>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">SLA Plan:</label>
                        </td>
                        <td>
                        	<p><?php echo $SLAPlan; ?></p>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Due Date:</label>
                        </td>
                        <td>
                        	<P><?php echo $duedate; ?></P>
                        </td>
                        <td>
                   </tr>     
                   <tr>
                        <td>
                        	<label id="label" >Due Time:</label>
                        </td>
                        <td><p><?php echo $duetime; ?></p></td>
                   </tr>     
                   <tr>
                   		<td>
                        	<label id="label">Assign to:</label>
                        </td>
                        <td><p><?php echo $assignto; ?></p></td>
                   </tr>
                </table><br>
                <!-- START OF ITEM DETAILS-->
                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets2">Item Details</th>
                    </tr>
                </Table><br>
                
                <table id="itemdetails">
                	<tr>

                        <td width="160px">
                        	<label id="label" name="unitbrand">Unit Brand</label>
                        </td>
                        <td width="160px">
                        	<label id="label" name="unitmodel">Unit Model</label>
                        </td>
                        <Td width="130px">
                        	<label id="label" name="serialno">Machine / Part No</label>
                        </Td>
                        <td width="110px">
                        	<label id="label" name="partno">Serial No</label>
                        </td>

                        <Td width="150px">
                        	<label id="label" name="warranty">Warranty</label>
                        </Td>
                    </tr>
                </table>
                <table id="itemdetails2">
                	
                    
                    <?php echo $itemDetails; ?>
                    
                </table>
                <!-- END OF ITEM DETAILS-->
                
                <div id="ticket_summary" style="border:solid 1px #999999;width:95%;margin:20px auto;">
                
                <table id="table2" style="margin-top:15px">
                	<tr>
                    	<td>
                        	<h4><?php if(isset($ticketTimeCreated)){ echo $ticketTimeCreated; }  ?> <?php if(isset($ticketDateCreated)){ echo $ticketDateCreated; } ?></h4>
                        </td>
                    </tr>
                    <tr>
                    	<td >
                        	<label id="label" style="font-weight:bold;">Subject: </label>
                            <label id="label"><?php echo $subject; ?></label>
                        </td>
                        
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label" style="font-weight:bold">
                            	Issue: 
                            </label>
                            <label id="label"><?php echo $issue; ?></label>
                        </td>
                    </tr>
                </table><br>
                
                <table id="table2">
                	<tr>
                    	<td>
                        	<label id="label" style="font-weight:bold;">Remarks:</label>
                            <label id="label"><?php echo $remarks; ?></label>
                        </td>
                        
                    </tr>
                    <tr>
                    	<td>
                        <label id="label"><p>Attachments:</label>
                        <ul>
                        	<?php echo $attachment; ?>
                        </ul>
                        
                        </td>
                    </tr>
                </table>
                

                </div>

                    <Table style="margin-left:auto; margin-right:auto; margin-bottom:20px">
            		<tr>
                    	<th id="opentickets2">
                        Comments / Messages
                        </th>
                       
                    </tr>
                </Table>


<div id ="ticketsScroll">
                <?php echo $ListOfComment; ?>
 </div>               

                <!-- Start with post comment-->
                <form action="csr_ticket.php" method="post">
                	
                    <Table style="margin-left:auto; margin-right:auto; margin-top:20px">
            		<tr>
                    	<th id="opentickets2">
                        Message: The user will be able to see the summary below and any associated responses.
                        </th>
                       
                    </tr>
                </Table>
                
                <table id="table2" style="margin-top:15px">
                	
                    
                    <tr>
                    	<td>
                        	<label id="label" style="font-weight:bold">
                            	Add Comment: 
                            </label>
                            <!--
                            <label id="label">Details on the reason(s) for opening the ticket.</label>-->
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<textarea id="textarea" rows="10" cols="20" name="commentbox"></textarea>
                        </td>
                    </tr>
                </table>
                <table>
                <tr><td>
                <input type="hidden" value="<?php echo $sv_number; ?>" name="ticketNo">
                <input type="hidden" value="<?php echo $log; ?>" name="log">
                <input type="submit" value="submit" name="postComment" class="myButton">
                <input type="submit" value="clear" onClick="return false" class="myButton">
                </td> </tr>
                 </table>	
                <br><br><br>
                </form>
                
                
                
     <!-- end of content -->
     </div>
   		
      
   </div>
  
     <!--end of body -->       
   </div>  
       
 </div>
<!-- end of container --> 
       
</div><br>
<span><?php include("includes/footer.php"); ?></span> 
</body>
</html>