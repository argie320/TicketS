<?php 
include("functions/loggedIn.php");
require_once('includes/config.php');
include("asset/attachment.class.php");
include("asset/steadFast.class.php");
include("asset/customer.class.php");


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
	
	$attachment = "";


$tabledata ="";

function DisplayListofEngineer(){
    /*
    $app = new steadFast();
    $list = $app->getEmployee(1);
    $person = '';
    foreach ($list as $pname => $email){
        echo "".$pname.'';
        $person .= '<option value="'.$email.'"> '.$pname.' , '.$email.' </option>';
    }
    */
}


if(isset($_GET['id'])){
	
	$id=  preg_replace('#[^0-9]#i', '' , stripslashes( strip_tags( trim(  $_GET['id'] ) )));
	
	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,  
                                                      DB_DATABASE) or trigger_error('Error'); 
	/*
	$sql = "SELECT  DISTINCT *
FROM `tbcustomer` INNER JOIN sv_ticket_header ON tbcustomer.sv_number = sv_ticket_header.sv_number INNER JOIN sv_ticket_details ON tbcustomer.sv_number = sv_ticket_details.sv_number INNER JOIN sv_ticket_details_attachment ON tbcustomer.sv_number = sv_ticket_details_attachment.sv_number INNER JOIN sv_ticket_item_details ON tbcustomer.sv_number = sv_ticket_item_details.sv_number 
WHERE tbcustomer.sv_number = ".$id." AND sv_ticket_item_details.sv_number = ".$id."";
*/
	$sql = "SELECT  DISTINCT *
FROM tbcustomer INNER JOIN sv_ticket_header ON tbcustomer.sv_number = sv_ticket_header.sv_number INNER JOIN sv_ticket_item_details ON tbcustomer.sv_number = sv_ticket_item_details.sv_number INNER JOIN sv_ticket_details ON tbcustomer.sv_number = sv_ticket_details.sv_number WHERE sv_ticket_header.sv_number = ".$id." ";
	
	
	$sql_load_attachment = "SELECT * FROM `sv_ticket_details_attachment` WHERE sv_number =  ".$id."";

    //Call the method
    $app = new steadFast();
    $list = $app->getEmployee(0);
    $person = '';
    foreach ($list as $pname => $email){
        echo "".$pname.'';
        $person .= '<option value="'.$email.'"> '.$pname.' , '.$email.' </option>';
    }
	
	
	$result = mysqli_query($dbc, $sql);
	
	
	//Important Information
	if($result->num_rows){
            
         while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
/*
             $this->custcode = $code;
             $this->ContactName = $name;
             $this->EmailAddress = $email;
             $this->ContactNumber = $contactNum;
             $this->FaxNo = $fax_number;
             $this->Address = $address;
             $this->ContactPerson = $contactperson;
*/
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
				
				$subject = $row['subject'];
				$issue = $row['issue'];
				$remarks = $row['remarks'];
				
				
				$itemDetails .= '
				<tr>
                    	<td width="60px" id="tdtyle">
                        	<input type="text" id="itemno" value="'.$item.'" readonly>
                        </td>
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
                        <td width="50px" id="tdtyle">
                        	<input type="text" id="qty" value="'.$Quantity.'" readonly>
                        </td>
                        <td width="150px" id="tdtyle" >
                        	<select name="warranty">
                                <option value='.$Warranty.'>'.$Warranty.'</option>
                            </select>
                        </td>
                    </tr>';

				
			}     
	}
	
	//Load Attachment and generate
	$result_for_attachment = mysqli_query($dbc, $sql_load_attachment);
	if($result_for_attachment->num_rows){
            
         while ($row = $result_for_attachment->fetch_array(MYSQLI_ASSOC)) {
			 
			 	
				$attachment .= '<li><a href="attachment/'.$row['sv_number'].'/'.$row['uniqid'].'" target="_blank">'.$row['attachment'].'</a></li>';
				
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
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
    
</head>

<body>
<div id="container">
	<div id="body">
   	 <?php include "includes/header.php"; ?>
     
     
     <div id="content">
     
     	<!-- START OF NAVBAR2 -->
            	<?php include("includes/nav.php"); ?>
            <!-- END OF NAVBAR2 -->
            
            
             <!-- START OF NAVBAR2 -->
            	<?php include("includes/ticket_navigation.php"); ?>
            <!-- END OF NAVBAR2 -->
     
     		<div id="content">
          
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
                        <td>
                            <select id="input2" class="assignto" name="assignto">
                                <option value="assign">--Select Staff Member OR a Team--</option>
                                <?php echo $person; ?>
                            </select>
                        </td>
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
                    	<td width="60px" >
                        	<label id="label" name="itemno">Item No</label>
                        </td>
                        <td width="160px">
                        	<label id="label" name="unitbrand">Unit Brand</label>
                        </td>
                        <td width="160px">
                        	<label id="label" name="unitmodel">Unit Model</label>
                        </td>
                        <Td width="130px">
                        	<label id="label" name="serialno">Machine / Serial No</label>
                        </Td>
                        <td width="110px">
                        	<label id="label" name="partno">Part No</label>
                        </td>
                        <td width="50px">
                        	<label id="label" name="qty">Quantity</label>
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
                
                
                <?php include("ticket-reply.php"); ?>
                
                
                <!-- end of ticket_summary-->
                </div>
                
                
                
                
                
     <!-- end of content -->
     </div>
   		
      
     
     <!--end of body -->       
     </div>
        <center><font face="century gothic" size="-1"><p>  AtomIT Solutions &copy;  All rights reserved 2014.mpz</p></font></center>


<!-- end of container -->        
</div>
</body>
</html>