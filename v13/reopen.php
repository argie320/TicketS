<?php
include "init.php";

    $attachment="";
    $itemDetails = "";
	
	$reopenfullname="";
	$ticketSenderEmail="";					
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
$person = '';	
$personInfo = new PersonInfo();	
$personName = $personInfo->getSuperVisor();

foreach($personName as $key => $list){
    $person .= '<option value="'.$list['Email'].'"> '.$list['FullName'].' , '.$list['Email'].' </option>';

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
FROM tbcustomer INNER JOIN sv_ticket_header ON tbcustomer.sv_number = sv_ticket_header.sv_number INNER JOIN sv_ticket_item_details ON tbcustomer.sv_number = sv_ticket_item_details.sv_number INNER JOIN sv_ticket_details ON tbcustomer.sv_number = sv_ticket_details.sv_number WHERE sv_ticket_header.sv_number = ".$id." AND sv_ticket_header.isClosed = 1 AND sv_ticket_header.log_ID = ".$log."";
	
	
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
				$ticketSenderEmail = $row['ticketSenderEmail'];
				
				$item = $row['item'];  
				$Unit_Brand = $row['Unit_Brand'];  
				$Unit_Model = $row['Unit_Model'];  
				$Machine_Serial_No = $row['Machine_Serial_No'];   
				$Part_No_Quantity = $row['Part_No_Quantity'];   
				$Quantity = $row['Quantity'];   
				$Warranty = $row['Warranty'];   
				$sv_number = $row['sv_number']; 
				
				$ticketTimeCreated = $row['time_created'];
				$ticketDateCreated = $row['date_created'];
				

			
				
				
		/**		$itemDetails .= '
				<tr>

                        <td width="160px" id="tdtyle">
                        	<input type="text" id="unitbrand" value="'.$Unit_Brand.'" >
                        </td>
                        <Td width="160px" id="tdtyle">
                        	<input type="text" id="unitmodel" value="'.$Unit_Model.'" >
                        </Td>
                        <Td width="130px" id="tdtyle">
                        	<input type="text" id="serial" value="'.$Machine_Serial_No.'" >
                        </Td>
                        <td width="110px" id="tdtyle">
                        	<input type="text" id="partno" value="'.$Part_No_Quantity.'">
                        </td>
                        <td width="150px" id="tdtyle" >
                        	<select name="warranty">
							    <option>'.$Warranty.'</option
                                <option value="Under Warranty">Under Warranty</option>
								<option value="No Warranty">No Warranty</option>
                            </select>
                        </td>
                    </tr>';  **/
					

				
			}     
	}
	
	//load ticket details
		$itemSQL = DB::getInstance()->prepare("SELECT * FROM sv_ticket_details INNER JOIN sv_ticket_header 
	                                       ON sv_ticket_details.log_ID = sv_ticket_header.log_ID 
										   WHERE sv_ticket_details.sv_number=? AND sv_ticket_header.log_ID=?");
	    $itemSQL->execute(array($id,$log));
	if($itemSQL->rowCount()){
            
         while ($row = $itemSQL->fetch(PDO::FETCH_ASSOC)) {
				$subject = $row['subject'];
				$issue = $row['issue'];
				$remarks = $row['remarks']; }}
	
//Load Item that closed	
	$itemSQL = DB::getInstance()->prepare("SELECT * FROM sv_ticket_item_details INNER JOIN sv_ticket_header 
	                                       ON sv_ticket_item_details.sv_number = sv_ticket_header.sv_number 
										   WHERE sv_ticket_item_details.sv_number=?");
	$itemSQL->execute(array($id));
			 
if($itemSQL->rowCount()){
            
         while ($row = $itemSQL->fetch(PDO::FETCH_ASSOC)) {
			 	$Unit_Brand = $row['Unit_Brand'];
				$Unit_Model = $row['Unit_Model'];
                $Machine_Serial_No = $row['Machine_Serial_No'];
				$Part_No_Quantity = $row['Part_No_Quantity'];
			  }} 	
	
	
	
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



 $qry2 = DB::getInstance()->prepare("SELECT fullname FROM gagamit WHERE gagamit.email = ?");
$qry2->execute(array($assignto));
	if($qry2->rowCount()){
         while ($row = $qry2->fetch(PDO::FETCH_ASSOC)) {  $fullnameSV =$row['fullname'] ; }}else{ echo "No Record"; }





if(isset($_POST['postComment'])){
	
	 
	
    $ticketNumber = $_POST['ticketNo'];
    $username = $_SESSION['username'];
    $MessageReplay = htmlspecialchars( $_POST['commentbox'],  ENT_QUOTES );

    if(isset($MessageReplay)){

        $ticketReplay = new Ticketreplay( $ticketNumber ,  $username);
        $status =  $ticketReplay->postComment( $ticketNumber , $MessageReplay, $username);

        if(isset($status)){

            switch($status){
                case 1:
                    Redirect::to( 5, 'reopen?id='.$ticketNumber.'' );
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



if(isset($_POST['assign'])){
	     

 include_once('classes/WorkReply.php');

   $tSender = $_POST['ticketSender'];

   $qry = DB::getInstance()->prepare("SELECT fullname FROM gagamit WHERE email = ?");
   $qry->execute(array($tSender));
	if($qry->rowCount()){
         while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {  $reopenfullname = $row['fullname'] ; }}else{ echo "No Record";}

 $newAssign = $_POST['assignto'];
 $reason = $_POST['commentbox1'];
 $sv_num = $_POST['ticketNo'];
 $tlog = $_POST['logID'];

 $tSource = $_POST['ticketsource'];
 $tDepartment = $_POST['department'];
 $tCompany = $_POST['company'];
 $tReference = $_POST['reference'];
 $tHelptopic = $_POST['helptopic'];
 $tPriority = $_POST['priority'];
 $tSlaplan = $_POST['slaplan'];
 $tDuedate = $_POST['duedate'];
 $tDuetime = $_POST['duetime'];
 $tUser = $_SESSION['username'];
 $tStatus = "Open";

 $tsubject = $_POST['subject'];
 $tissue = $_POST['issue'];
 $tremarks = $_POST['remarks'];



				// check for existing open ticket
				       $chkForOpen = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header
					                                     INNER JOIN ticket_status ON sv_ticket_header.log_ID = ticket_status.log_ID
														 WHERE sv_ticket_header.sv_number = ? 
														 AND sv_ticket_header.isClosed = 0");
					   $chkForOpen->execute(array($sv_num));
					   if($chkForOpen->rowCount()){
						
						 while($row = $chkForOpen->fetch(PDO::FETCH_ASSOC)){
							 $m = $row['sv_number'];
							 $l = $row['log_ID'];
						 }
						 		 echo '<script type="text/javascript">'; 
		                         echo "alert('Ticket number $m is already opened.');"; 
                                 echo 'window.location.href = "myticket.php" </script>;';
						   
					   }else{
                          $reopenTicket = new ReopenTicket;
					      if(!empty($_FILES['attachment']['name'][0])){
		                      $uploader = $_FILES['attachment'];

	                          $fileScanner = new FileScanner($sv_num, '');
		
	        	              $isUploaded = $fileScanner->startScan($uploader);
		
		
		                       $Queryinsert_sv_ticket_details_attachment = $fileScanner->getInsertedQuery();

                              $insertNewAttachment = $reopenTicket->InsertAttachment($Queryinsert_sv_ticket_details_attachment);
					
					          }

				 	     
                         $InsertreOpen = $reopenTicket->Re_open($sv_num,$newAssign,$reason,$reopenfullname);
                         $UpdateHeader = $reopenTicket->InsertHeader($sv_num,$tUser,$tSender,$tSource,$tStatus,$newAssign,$tDepartment,$tCompany,
                         $tReference,$tDuedate,$tPriority,$sv_num,$tHelptopic,$tSlaplan,$tDuetime);
                         $InsertItem = $reopenTicket->InsertTicketDetails($sv_num,$tsubject,$tissue,$tremarks);	    
					     $addTicketstatus = $reopenTicket->UpdateTicketStatus($sv_num);
	                     $updateReopen =  $reopenTicket->UpdateReopenStatus($sv_num,$tlog);




    $ticketNumber = $_POST['ticketNo'];
    $username = $_SESSION['username'];
    $MessageReplay = "[ SYSTEM : TICKET RE-OPENED ] :".htmlspecialchars( $_POST['commentbox1'],  ENT_QUOTES );

    if(isset($MessageReplay)){

       $ticketReplay = new Ticketreplay( $ticketNumber ,  $username);
        $status =  $ticketReplay->postComment( $ticketNumber , $MessageReplay, $username);

        if(isset($status)){

            switch($status){
                case 1:
				
			
                         Redirect::to( 5, 'myticket?id='.$ticketNumber.'' );
					   
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
    <script type="text/javascript"src="js/newticket.js"></script>
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
  
     		<div id="content">

            <div id="errorMessage">
            <h1></h1>
            </div>

          
           <!-- START OF NEW TICKET AND USER INFORMATION!! -->
            <div id="tickets">
            	<table style="margin-left:auto; margin-right:auto;">
                	<br />
            		<tr>
                    	<th id="opentickets" style="text-align:center">Reopen Ticket</th>
                    </tr>
                    <tr>
                    	<th id="opentickets2">Customer Information</th>
                    </tr>
           		</table>
                
       <form action="reopen.php" method="post"  onsubmit="return Validate(this);" enctype="multipart/form-data">      
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
                    	<p><?php echo $Client->Address; ?></p>
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
                    <p><?php echo $Client->FaxNo; ?> </p>
                    	
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
                        	<select id="input2" name="ticketsource">
                            	<option><?php echo $source;  ?></option>
                                <option value="Phone">Phone</option>
                                <option value="Email">Email</option>
                                <option value="Walk-in">Walk-in</option>
                                <option value="other">Other</option>
                            </select>
                        </td>
                        
                    	<td>
                    		<label id="label" style="margin-left:40px;">Company:</label>
                    	</td>
                    	<td>
                    		<select id="input2" name="company">
                        		<option><?php echo $company;?></option>
                            	<option value="Stead Fast Solutions Inc.">Stead Fast Solutions Inc.</option>
                            	<option value="Jump Solutions Inc.">Jump Solutions Inc.</option>
                            	<option value="Forefront Innovative Technologies Inc.">Forefront Innovative Technologies</option>
                        	</select>
                    	</td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Department:</label>
                        </td>
                        <td>
                        	<select id="input2" name="department">
                            	<option><?php echo $department;?></option>
                                <option value="Internal">Internal</option>
                                <option value="External">External</option>
                            </select>
                        </td>
                        <td>
                   			<label id="label" style="margin-left:40px;">Reference</label>
                   		</td>
                		<td>
                        	<select id="input2"  name="reference">
                    			<option><?php echo $Reference;?></option>
                				<option value="HP">HP</option>
                    			<option value="IBM">IBM</option>
                    			<option value="ACER">ACER</option>
                			</select>
                    	</td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Help Topic:</label>
                        </td>
                        <td>
                        	<select id="input2" name="helptopic">
                            	<option><?php echo $HelpTopic;?></option>
                                <option value="Billing">Billing</option>
                                <option value="Request for Payment">Request for payment</option>
                                <option value="Support">Support</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Priority</label>
                        </td>
                        <td>
                        	<select id="input2" name="priority">
                            	<option ><?php echo $priority;?></option>
                                <option value="Low">Low</option>
                                <option value="Normal">Normal</option>
                                <option value="High">High</option>
                                <option value="Emergency">Emergency</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">SLA Plan:</label>
                        </td>
                        <td>
                        	<select id="input2" name="slaplan">
                            	<option><?php echo $SLAPlan;?></option>
                                <option value="Default SLA(48hrs-Active)">Default SLA (48 hrs - Active)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Due Date:</label>
                        </td>
                        <td>
                        	<input id="input2" type="date" name="duedate" value=<?php echo $duedate;?>> 
                        </td>
                        <td>
                   </tr>     
                   <tr>
                        <td>
                        	<label id="label">Due Time:</label>
                        </td>
                        <td>
                        	<input id="input2" type="time" name="duetime" value=<?php echo $duetime;?>>
                        </td>
                   </tr>     
                   <tr>
                   		<td>
                        	<label id="label">Assign to:</label>
                        </td>
                        <td>
          
                            <select id="input2" class="assignto" name="assignto">
                            	<option value="assign" disabled>--Select Staff Member OR a Team--</option>
                                <?php echo $person; ?>
                            </select>
                        </td>
                   </tr>
                </table><br>
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
				<tr>

                        <td width="160px" id="tdtyle">
                        	<input type="text" id="unitbrand" name="unitbrand" value=<?php echo $Unit_Brand; ?> readonly>
                        </td>
                        <Td width="160px" id="tdtyle">
                        	<input type="text" id="unitmodel" name="unitmodel" value=<?php echo $Unit_Model ?> readonly>
                        </Td>
                        <Td width="130px" id="tdtyle">
                        	<input type="text" id="serial" name="machine" value=<?php echo $Machine_Serial_No ?> readonly>
                        </Td>
                        <td width="110px" id="tdtyle">
                        	<input type="text" id="partno" name="serial" value=<?php echo $Part_No_Quantity ?> readonly>
                        </td>
                        <td width="150px" id="tdtyle" >
                        	<select name="warranty">
							    <option disabled><?php echo $Warranty;?></option

                            ></select>
                        </td>
                    </tr>
                    
                </table>
                <!-- END OF ITEM DETAILS-->
                
                <div id="ticket_summary" style="border:solid 1px #999999;width:95%;margin:20px auto;">
                
                <table id="table2" style="margin-top:15px">
                	<tr>
                    	<td>
                        	<h4><?php if(isset($ticketTimeCreated)){ echo $ticketTimeCreated; }  ?> <?php if(isset($ticketDateCreated)){ echo $ticketDateCreated; } ?></h4>
                        </td>
                    </tr>
                  </table><br>
                  
               <table id="table2">
                    <tr>
                    	<td >
                        	<label id="label" style="font-weight:bold;">Subject: </label>
                         
                        </td>
                        	<td >
                            <textarea id="input2" name="subject"><?php echo $subject; ?></textarea>
                        
                           </td>
                    </tr>
             
                    <tr>
                    	<td>
                        	<label id="label" style="font-weight:bold">Issue: </label>
                           
                        </td>
                         <td>   
                           <textarea id="textarea" rows="10" cols="20" name="issue"><?php echo $issue; ?></textarea> 
                        </td>
                    </tr>
          
                	<tr>
                    	<td>
                        	<label id="label" style="font-weight:bold;">Remarks:</label>
                            </td>
                         <td>   
                            <textarea id="textarea" rows="10" cols="20" name="remarks"><?php echo $remarks; ?></textarea>
                        </td>
                        
                    </tr>
                        </table>
                        
                    <table>    
                    <tr>
                    	<td>

                        <input id="submit" type="file" name="attachment[]" accept="image/*,text/plain,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple>
                        </td>
                    </tr>
               </table>
               <table>
               <tr>
               <td>
                 <label id="label"><p>Current Attachments:</p><?php echo $attachment; ?></label>
               </td>
               </tr>
               </table>
                

                <!-- end of ticket_summary-->
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
                    <Table style="margin-left:auto; margin-right:auto; margin-top:20px">
            		<tr>
                    	<th id="opentickets2">
                        Message: The user will be able to see the summary below and any associated responses.
                        </th>
                       
                    </tr>
                </Table>
                
    <!-- START OF TAB -->
          
    <div class="tabs">      
          
             <div class="tab">
                    <input type="radio" id="tab-1" name="tab-group-1" >
                    <label for="tab-1">Post Comment</label>       
               <div class="content">
                           
 <table>
    <tr> 
        <td>
        <textarea id="textarea" rows="10" cols="20" name="commentbox" placeholder="Type your comment here..."></textarea>
           
             

        </td>
    </tr> 
                 <tr> 
        <td>
             <input type="hidden" value="<?php echo $sv_number; ?>" name="ticketNo"> 
               <input type="submit" value="Submit" name="postComment" class="myButton">
                <input type="submit" value="clear" onClick="return false" class="myButton">
        

        </td>
    </tr>
    <input type="hidden" value="<?php echo $ticketSenderEmail ?>" name="ticketSender">
</table>        

              </div>
           </div>
           
           
           
           <div class="tab">
                  <input type="radio" id="tab-2" name="tab-group-1" checked >
                  <label for="tab-2">Reassign Ticket</label>
       
             <div class="content">
 <table>
        <tr> 
        <td>
               <p style="font-weight:bold;">Ticket currently assigned to: <?php echo $fullnameSV; ?></p>
                             
        </td>
        </tr>
        <tr> 
        <td>
            <textarea id="textarea" rows="10" cols="20" name="commentbox1" placeholder="----- Type your reasons for reopening ticket here -----"></textarea>

        </td>
        </tr>
    <tr> 
        <td>
    
               <input type="hidden" value="<?php echo $sv_number; ?>" name="ticketNo">
               <input type="hidden" value="<?php echo $log; ?>" name="logID">                                 
               <input type="submit" value="Re-open" name="assign" class="myButton">
               <input type="submit" value="clear" onClick="return false" class="myButton">
          

                   </td>
             </tr>

</table>             
              </div>
           </div>
          
     </div>     

    <!-- END OF TAB -->
                </form>
            
       </div>         
                
     <!-- end of content -->
     </div>
   		
</div>
     
   <br><br>     <!--end of body -->       
     </div>
 <br><br>  
<?php include("includes/footer.php"); ?>
<br><br>
<!-- end of container -->        
</div>
     
   
</body>
</html>

