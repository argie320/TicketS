
<?php

include "init.php";

$person = '';

$app = new steadFast();

$personInfo = new PersonInfo();

$personName = $personInfo->getSuperVisor();
//Array ( [root] => Array ( [FullName] => Melaine [Email] => derechoandro@yahoo.com [Company] => ump Solutions Inc. [MobileNumber] => 9325551294 ) )
foreach($personName as $key => $list){
    /*
    echo "Username.: " . $key . "\n";
    echo "Name: " . $list['FullName'] . "\n";
    echo "Email: " . $list['Email'] . "\n";
    */
    $person .= '<option value="'.$list['Email'].'"> '.$list['FullName'].' , '.$list['Email'].' </option>';

}



//Generate Service Number and display
$service_number  = $app->GenerateServiceNumber();



if(isset($_POST['open'])){
	
	/*******
		val:  'Open' , 'answered' ,'Closed', 'Overdue'
	*******/
	$ticketStatus = "Open";
	
	/*******
		val:  'Answered' , 'No Answer'
	*******/
	$ticketResponse = 0;
	$ticketTimeCreated = "time created";
	
	/****
		ticket who created 
	****/
//	$FromUser = preg_replace('#[^a-z0-9]#i', '' , stripslashes( strip_tags( trim(  $_SESSION['username'] ) )));
	$FromUser = Validate::escape($_SESSION['username']);
	$CurrentUserEmail = $app->getuseremail($FromUser);
	
	
	
	$custcode = $_POST["custcode"];
	$CustomerName = $_POST['customername']; 
	$EmailAddress = $_POST['emailaddress']; 
	$ContactNumber = $_POST['contactnumber']; 
	$FaxNo = $_POST['faxnumber']; 
	$Address = $_POST['address']; 
	$ContactPerson = $_POST['contactperson']; 
						
	$source = $_POST['ticketsource'];
	$department = $_POST['department']; 
	$HelpTopic = $_POST['helptopic'];
	$priority = $_POST['priority'];
	$SLAPlan = $_POST['slaplan'];
	$duedate  = $_POST['duedate'];
	$duetime = $_POST['duetime']; 
	$assignto = $_POST['assignto'];
	$company = $_POST['company'];
	$Reference = $_POST['reference'];
        
	//This should be deleted    
    $itemno = (isset($_POST['itemno'])) ? $_POST['itemno'] : "1";
    $unitbrand = $_POST['unitbrand'];
    $unitmodel = $_POST['unitmodel'];
    $serialno = $_POST['serialno'];
    $partno = $_POST['partno'];
    
	//This should be deleted
	$qty = ( isset($_POST['qty']) ) ? $_POST['qty'] : "1" ;
    $warranty = $_POST['warranty'];
						
	$subject = $_POST['subject'];
	$issue  = $_POST['issue'];
	$details = "No Details For Now";
	$remarks  =$_POST['remarks'];
	
	
	$itemDetailsQuery = "INSERT INTO sv_ticket_item_details ( item ,  Unit_Brand ,  Unit_Model ,  Machine_Serial_No ,  Part_No_Quantity ,  Quantity ,  Warranty, sv_number) VALUES ";
	
	$length = sizeof($itemno);
	
	for($i = 0; $i < $length; $i++) {
         
		 $itemDetailsQuery .=
		 		"('".$itemno[$i]."',
		 		'".$unitbrand[$i]."' ,'".$unitmodel[$i]."' ,
		 		'".$serialno[$i]."' ,'".$partno[$i]."' ,
		 		'".$qty[$i]."' ,'".$warranty[$i]."' ,
		 		'".$custcode."'),";
	}
	

	$itemDetailsQueryRemoveLastComma = rtrim($itemDetailsQuery, ',');
	
	$Queryinsert_sv_ticket_details_attachment = "SELECT * from sv_ticket_details_attachment;";
	
	
	//Check if has any attachment
	if(!empty($_FILES['attachment']['name'][0])){
		$uploader = $_FILES['attachment'];
		
		
		$fileScanner = new FileScanner($custcode, '');
		
		$isUploaded = $fileScanner->startScan($uploader);
		
		//echo ($isUploaded) ? "Success" : "Failed";
		
		$Queryinsert_sv_ticket_details_attachment = $fileScanner->getInsertedQuery();
			
		//echo $Queryinsert_sv_ticket_details_attachment;
			
	}
	
	if($CurrentUserEmail != ""){
	
	$s = $result =  $app->createServiceTicket(
						$ticketStatus,$ticketResponse,$ticketTimeCreated,$FromUser,$CurrentUserEmail,$custcode,
						$CustomerName,$EmailAddress ,$ContactNumber,$FaxNo,$Address,$ContactPerson ,
						$source,$department, $HelpTopic,$priority,$SLAPlan,$duedate,$duetime, $assignto,$company, $Reference,
                		$itemDetailsQueryRemoveLastComma,
						$subject,$issue,$details,$remarks,
						$Queryinsert_sv_ticket_details_attachment
					);	

	}
	
	

	
}


?>
<!doctype html>
<html>
<head>
	
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

	<title>New Ticket - Service Ticket</title>
	<link type="text/css" rel="stylesheet" href="css/newticket.css" />
	<link rel="stylesheet" type="text/css" href="css/menu2.css" />

    
    <style type="text/css">
	#suggestion{
		display:none;
		position: absolute;
  margin: 0 auto;
  background-color: white;
  z-index: 1;    
  width: 300px;
  height: 180px;
  border-top-style: solid;
  border-right-style: solid;
  border-left-style: solid;
  border-collapse: collapse;
  border-bottom-style: solid;
  border-color: #000000;
  border-width: 1px;      
  overflow: auto
	}
	</style>
    
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript"src="js/newticket.js"></script>
     <script type="text/javascript">

		 
	 </script>

</head>

<body>
<div id="container">
	<div id="body">
     
     <?php include "includes/header.php" ?>
     
     <div id="content">

        
            	<?php include("includes/CSRHeader.php"); ?>
         
     
     		<div id="content">
            
           <form action="newticket.php" method="post" onsubmit="return Validate(this);" enctype="multipart/form-data"> 
          
           <!-- START OF NEW TICKET AND USER INFORMATION!! -->
            <div id="tickets">
            	
                <?php include ("includes/customer_information.php"); ?>
                
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
                            	<option>--Select Source--</option>
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
                    		<select id="input" style="margin-left:55px" name="company">
                        		<option value="0">--Select Company--</option>
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
                            	<option value="0">--Select Department-</option>
                                <option value="Internal">Internal</option>
                                <option value="External">External</option>
                            </select>
                        </td>
                        <td>
                   			<label id="label" style="margin-left:40px;">Reference</label>
                   		</td>
                		<td>
                        	<select id="input" style="margin-left:55px" name="reference">
                    			<option>--Select Reference--</option>
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
                            	<option value="0" disabled>--Select Help Topic--</option>
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
                            	<option >--System Default--</option>
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
                            	<option value="0" >--System Default--</option>
                                <option value="Default SLA(48hrs-Active)">Default SLA (48 hrs - Active)</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Due Date:</label>
                        </td>
                        <td>
                        	<input id="datecss" type="date" name="duedate" min="<?php date_default_timezone_set("Etc/GMT+8"); echo date('Y-m-d'); ?>" > 
                        </td>
                        <td>
                   </tr>     
                   <tr>
                        <td>
                        	<label id="label" >Due Time:</label>
                        </td>
                        <td>
                        	<input id="input2" type="time" name="duetime">
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
                <!-- START OF ITEM DETAILS-->
                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets2">Item Details</th>
                    </tr>
                </Table><br>
                
                <table id="itemdetails">
                	<tr>

                        <td width="160px">
                        	<label id="label" >Unit Brand</label>
                        </td>
                        <td width="160px">
                        	<label id="label" >Unit Model</label>
                        </td>
                        <Td width="130px">
                        	<label id="label" >Machine / Part No</label>
                        </Td>
                        <td width="110px">
                        	<label id="label">Serial No</label>
                        </td>
                        <Td width="150px">
                        	<label id="label" name="warranty">Warranty</label>
                        </Td>
                    </tr>
                </table>
                <table id="itemdetails2">
                	<tr>

                        <td width="160px" id="tdtyle">
                        	<input type="text" id="unitbrand" name="unitbrand[]">
                        </td>
                        <Td width="160px" id="tdtyle">
                        	<input type="text"  id="unitmodel" name="unitmodel[]" >
                        </Td>
                        <Td width="130px" id="tdtyle">
                        	<input type="text" id="serial" name="serialno[]">
                        </Td>
                        <td width="110px" id="tdtyle">
                        	<input type="text" id="partno"  name="partno[]">
                        </td>
                        <td width="150px" id="tdtyle">
                        	<select name="warranty[]">
                            	<option disabled>--Select Warranty</option>
                            	<option value="Under Warranty">Under Warranty</option>
                                <option value="No Warranty">No Warranty</option>
                            </select>
                        </td>
                    </tr>
                    
                    
                    
                    
                   
                </table>
                <table>
             <!--       <tr>
                    	<td><button onClick="return false" id="addRow" >Add Row</button></td>
                    
                    	<td><button onClick="return false" id="removeRow" >Remove Row</button></td>
                    </tr> -->
                </table>
                <!-- END OF ITEM DETAILS-->
                <Table style="margin-left:auto; margin-right:auto; margin-top:20px">
            		<tr>
                    	<th id="opentickets2">
                        Issue: The user will be able to see the issue summary below and any associated responses.
                        </th>
                       
                    </tr>
                </Table>
                <table id="table2" style="margin-top:15px">
                	<tr>
                    	<td>
                        	<label id="label" style="font-weight:bold">Subject: </label>
                            <label id="label">Issue summary.</label>
                        </td>
                        
                    </tr>
                    <tr>
                    	<td>
                        	<input id="issueinput" type="text" name="subject">
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label" style="font-weight:bold">
                            	Issue: 
                            </label>
                            <label id="label">Details on the reason(s) for opening the ticket.</label>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<textarea id="textarea" rows="10" cols="20" name="issue"></textarea>
                        </td>
                    </tr>
                </table><br>
                <Table style="margin-left:auto; margin-right:auto;">
            		<tr>
                    	<th id="opentickets2">
                        	Remarks: Optional remarks to the above issue.
                        </th>
                    </tr>
                </Table><br>
                <table id="table2">
                	<tr>
                    	<td>
                        	<label id="label" style="font-weight:bold;">Remarks:</label>
                        </td>
                        
                    </tr>
                    <tr>
                    	<td>
                        	<textarea id="textarea" rows="10" cols="20" name="remarks"></textarea>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        <label id="label"><p>Attachments:</label>
                        <input id="submit" type="file" name="attachment[]" accept="image/*,text/plain,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple>
                        </td>
                    </tr>
                </table>
                <table style="margin:auto; margin-top:15px;">
                    <tr>
                    	<td id="submit2">
                        	
                        		<input id="submit2" type="submit" name="open" Value="Open" class="myButton">
                            	<input id="submit2" type="submit" name="reset" Value="Reset" class="myButton">
                            	<input id="submit2" type="submit" name="cancel" Value="Cancel" class="myButton">
                         </td>
               

                    </tr>
                 <!-- START OF TICKET INFORMATION & OPTION!! -->
                </table>
                  </form>
                
     <!-- end of content -->
     </div>
   	
     <!--end of body -->       
     </div>
      

</div>

<!-- end of container -->        
</div><br>
 <span>  <?php include("includes/footer.php"); ?> </span>
</body>
</html>