<!--   ///////////////////////////////////////////////////////////////////////// -->
<?php
include("init.php");
include_once("functions/loggedIn.php");


$itemDetails = "";
$rNo="";
$preparedfullname="";
$pulloutfullname="";
$id="";
$ticketNo="";
$pulloutEngr="";
$pulloutNo="";
$log="";

$pNo="";
$pDate="";

$custcode = "";
	$CustomerName = "";
	$EmailAddress = "";
	$ContactNumber = "";
	$FaxNo = "";
	$Address = "";
	$ContactPerson = "";
						
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

if(isset($_GET['id']) && isset($_GET['log'])){

	$id=  preg_replace('#[^0-9]#i', '' , stripslashes( strip_tags( trim(  $_GET['id'] ) )));
	$log=  preg_replace('#[^0-9]#i', '' , stripslashes( strip_tags( trim(  $_GET['log'] ) )));

 //	$dbc = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,
   //                                                   DB_DATABASE) or trigger_error('Error');

	$sql_ =DB::getInstance()->prepare("SELECT DISTINCT *
FROM `tbcustomer` INNER JOIN sv_ticket_header ON tbcustomer.sv_number = sv_ticket_header.sv_number
INNER JOIN sv_ticket_details ON tbcustomer.sv_number = sv_ticket_details.sv_number
INNER JOIN sv_ticket_details_attachment ON tbcustomer.sv_number = sv_ticket_details_attachment.sv_number
INNER JOIN sv_ticket_item_details ON tbcustomer.sv_number = sv_ticket_item_details.sv_number
INNER JOIN wo_ticket_details ON wo_ticket_details.log_No = sv_ticket_header.log_ID
WHERE tbcustomer.sv_number = ? AND sv_ticket_item_details.sv_number = ? AND wo_ticket_details.log_No=?");
  $sql_->execute(array($id,$id,$log));

  //	$result = mysqli_query($dbc, $sql);
	echo $loginSuccess = FALSE;

	if($sql_->rowCount()){

         while ($row = $sql_->fetch(PDO::FETCH_ASSOC)) {

                $workOrderNo = $row['work_number'];

				$custcode = $row['customer_snum'];
				$CustomerName = $row['customer_name'];
				$EmailAddress = $row['customer_email'];
				$ContactNumber = $row['customer_cnum'];
				$FaxNo = $row['customer_fnum'];
				$Address = $row['customer_baddr'];
				$ContactPerson = $row['customer_contact'];
            

				$source  = $row['source'];
				$department = $row['department'];
				$HelpTopic = $row['help_topic'];
				$priority = $row['priority'];
				$SLAPlan = $row['slaplan'];
				$duedate = $row['duedate'];
				$duetime= $row['duetime'];
				$assignto = $row['assignto'];
				$ticketSenderEmail = $row['ticketSenderEmail'];
				
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


				$pulloutEngr = $row['assignToEngineer'];

				$attachment = $row['attachment'];

             // $data .= "$source $assignto $subject $issue $remarks $department $company $duedate";
                                //echo  $data;

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
	
	
	

$ItemDetailsClass = new ItemDetails();

$itemDetailsResult = DB::getInstance()->query(" SELECT * FROM sv_ticket_item_details  WHERE sv_number = ".$id."");

while($row = $itemDetailsResult->fetch()){

    $ItemDetailsClass->addDetails($row['item'], $row['Unit_Brand'],$row['Unit_Model'],$row['Machine_Serial_No'],$row['Part_No_Quantity'],$row['Quantity'],$row['Warranty'],$row['sv_number']);

}

$items =  $ItemDetailsClass->Unit_Brand;

$itemDetails ='';
for($i = 0;  $i < sizeof($items); $i++){

   $itemDetails .= '<tr>

                       <td width="160px" id="tdtyle">
                           <input type="text" id="unitbrand" value="'.$ItemDetailsClass->Unit_Brand[$i].'" readonly>
                       </td>
                       <Td width="160px" id="tdtyle">
                           <input type="text" id="unitmodel" value="'.$ItemDetailsClass->Unit_Model[$i].'" readonly>
                       </Td>
                       <Td width="130px" id="tdtyle">
                           <input type="text" id="serial" value="'.$ItemDetailsClass->Machine_Serial_No[$i].'" readonly>
                       </Td>
                       <td width="110px" id="tdtyle">
                           <input type="text" id="partno" value="'.$ItemDetailsClass->Part_No_Quantity[$i].'" readonly>
                       </td>

                       <td width="150px" id="tdtyle" >
                           <select name="warranty">
                               <option value='.$ItemDetailsClass->Warranty[$i].'>'.$ItemDetailsClass->Warranty[$i].'</option>
                           </select>
                       </td>
                   </tr>';
}
//////////////////////// GENERATE AUTO WORK# /////////////////////////////////////////////



$pulloutNo=rand(1,999999);


 $qry = DB::getInstance()->prepare("SELECT fullname FROM gagamit WHERE gagamit.email = ?");
$qry->execute(array($ticketSenderEmail));
	if($qry->rowCount()){
         while ($row = $qry->fetch(PDO::FETCH_ASSOC)) {  $preparedfullname =$row['fullname'] ; }}else{ echo "No Record";}
 
  $qry2 = DB::getInstance()->prepare("SELECT * FROM gagamit WHERE gagamit.email = ?");
$qry2->execute(array($pulloutEngr));
	if($qry2->rowCount()){
         while ($row = $qry2->fetch(PDO::FETCH_ASSOC)) { $pulloutfullname =$row['fullname'] ; }}else{ echo "No Record"; }





 }

?>

<!--   ///////////////////////////////////////////////////////////////////////// -->
<?php

    if(isset($_POST['submit1'])){
	     
		 $id = $_POST['svnumber'];
		 $tlog = $_POST['log'];
		 
		
		  $chkPulloutNo = DB::getInstance()->prepare("SELECT * FROM sv_ticket_header 
		                   INNER JOIN tb_pullout ON sv_ticket_header.log_ID = tb_pullout.log
						   WHERE tb_pullout.sv_number= ? AND tb_pullout.log=?");
		  $chkPulloutNo->execute(array($id,$tlog));
    if($chkPulloutNo->rowCount()){
			  
         while ($row = $chkPulloutNo->fetch(PDO::FETCH_ASSOC))
		 {
	       
		 $pStatus = $row['status'];
		 $pNO = $row['pulloutNo'];
		 $ticketNo = $row['sv_number'];
		 $pDate = $row['pulloutDate'];
		

		 }
		 		 
		 echo '<script type="text/javascript">'; 
		 echo "alert('Ticket number $ticketNo has been pullout last $pDate');"; 
         echo 'window.location.href = "myworkorder.php" </script>;';
		 	
		 
		  } 

	else{  			   




     $type=$_POST['typeOf'];
     $remarks=$_POST['remarks'];
     $prepared=$_POST['preparedBY'];
     $pullout=$_POST['pulloutBY'];
     $pulloutNo = $_POST['pulloutNo'];
    

     $result=DB::getInstance()->prepare("INSERT INTO tb_pullout
        (log,sv_number,pullout_type,pullout_remarks,preparedBy,pulloutBy,pulloutDate,pulloutNo)VALUES(?,?,?,?,?,?,now(),?)");
     $result->execute(array($tlog,$id,$type,$remarks,$prepared,$pullout,$pulloutNo));
        header("Location: pulloutPDF.php?id='".$id."'&&log='".$tlog."'");


 }

}


?>




<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
	<link rel="stylesheet" type="text/css" href="css/pulloutslip.css">
<link rel="stylesheet" type="text/css" href="css/menu2.css" />

<!-- CSS CODE FOR TAB TAB TAB TAB-->
<style type="text/css">
.tabs {
  position: relative;
  min-height: 265px; /* This part sucks */
  clear: both;
  margin: 25px 0;
}
.tab {
  float: left;
}
.tab label {
  background: #eee;
  padding: 10px;
  border: 1px solid #ccc;
  margin-left: -1px;
  position: relative;
  left: 1px;
  font:10pt century gothic;
  color:#666;
}
.tab [type=radio] {
  display: none;
}
.content {
  position: absolute;
  top: 28px;
  left: 0;
  background: white;
  right: 0;
  bottom: 0;
  padding: 3px;
  border: 1px solid #ccc;
}
[type=radio]:checked ~ label {
  background: white;
  border-bottom: 1px solid white;
  z-index: 2;
}
[type=radio]:checked ~ label ~ .content {
  z-index: 1;
}

</style>
<!-- END OF CSS CODE FOR TAB TAB TAB TAB-->


</head>

<body>
<div id="container">
	<div id="body">

            <div id="header">
   <div id="logout">Welcome, <a href="changepass_engr.php" style="color:#06F;text-transform:capitalize"><?php echo $_SESSION['username']; ?></a> | <a href="logout.php"><font color="orange">Logout</font></a></div>
             </div>
   		<div id="content">
     

           <div class="cssmenu">
            	
   					<a href='dashboard.php'><span>Dashboard</span></a>
   					<a href='myworkorder.php'><span>Work Order</span></a>
               
            </div>
            <div class = "cssmenusub">
            <!-- END OF NAVBAR --->
     <!-- START OF NAVBAR2 -->

            <div id="navbar2">
            	<table id="navbar3" style="margin:auto">
                	<tr >

                    </tr>
                </table>
            </div>

  <form method="POST" action="pulloutslip.php">
           <!-- END OF NAVBAR2 -->
            <table style="margin-left:auto; margin-right:auto;">
                	<tr>
                    	<td>
                        	<label id="label" style="margin-left:5px; font-size:14px; font-weight:bold">Pull-out Slip Type:</label>
                        	<select name="typeOf" id="input" style="width:100px">
                            	<option value="customer">Customer</option>
                                <option value="supplier">Supplier</option>
                            </select>
                        	<label id="label" style="margin-left:230px; font-weight:bold; font-size:14px">Ticket#:</label>
                            <label id="label" style="margin-left:5px; font-size:14px"><?php echo (isset($sv_number))? $sv_number : "Undefined"; ?></label>
                            <label id="label" style="margin-left:10px">|</label>
                            <label id="label" style="margin-left:10px; font-weight:bold; font-size:14px">Work Order#:</label>
                            <label id="label" style="margin-left:5px; font-size:14px"><?php echo (isset($workOrderNo)) ? $workOrderNo : "Undefined"; ?></label>
                            <label id="label" style="margin-left:10px">|</label>
                            <label id="label" style="margin-left:10px; font-weight:bold; font-size:14px">Control#:</label>
                            <label id="label" style="margin-left:5px; font-size:14px"><?php echo (isset($pulloutNo)) ? $pulloutNo : "Undefined"; ?></label>
                               <input type="text" name="pulloutNo" value="<?php echo $pulloutNo ?>" hidden/>
                       </td>
                    </tr>
                    <tr>
                    	<th id="opentickets" style="font-weight:bold; text-align:center">Pull-out Slip</th>
                    </tr>
        </table><br>
     		<table id="table2">
            		<tr>
                    	<td>
                        	<label id="label">Customer Name:</label>
                        </td>
                        <td>
                        	<label id="label2"><?php echo $CustomerName; ?></label>
                        </td>
                        <td>
                        	<label id="label" style="margin-left:115px">Company Name:</label>
                        </td>
                        <td>
                        	<label id="label2"><?php echo $company; ?></label>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Email Address:</label>
                        </td>
                        <td>
                        	<label id="label2"><?php echo $EmailAddress; ?></label>
                        </td>
                    	<td>
                        	<label id="label" style="margin-left:115px">Company Address:</label>
                        </td>
                        <td>
                        	<label id="label2"><?php echo $Address; ?></label>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Contact Number:</label>
                        </td>
                        <td>
                        	<label id="label2"><?php echo $ContactNumber; ?></label>
                        </td>
                        <td>
                        	<label id="label" style="margin-left:115px">Contact Person:</label>
                        </td>
                        <td>
                        	<label id="label2" ><?php echo $ContactPerson; ?></label>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<label id="label">Fax No:</label>
                        </td>
                        <td>
                        	<label id="label2"><?php echo $FaxNo; ?></label>
                        </td>
                    </tr>
            </table><br><br>
            <!-- START OF ITEM DETAILS -->
            <table>
     				<tr>
                    	<th id="opentickets2">ITEM DETAILS</th>
                	</tr>
           	</Table><br>
            <table id="itemdetails">
                          <?php echo $itemDetails; ?>
                </table><br><br>
                <table id="itemdetails">
                	<tr>
                    	<td>
                        	<label id="label2">Problem Encountered</label>
                        </td>
                    </tr>
                </table>
                 <table id="itemdetails2">
                	<tr>
                    	<td id="tdtyle">
                        	<label id="label">
                            	<?php echo $issue; ?>
                            </label>
                        </td>
                    </tr>
                </table>
                <!-- END OF ITEM DETAILS--><br><br>


            <table id="remarks">

            	<tr>
                	<Td>Remarks:</Td>
                    <td>
                    	<textarea rows="2" cols="10" id="textarea2" name="remarks"></textarea>
                    </td>
               </tr>
            </table><br><br>


            	<label id="label" style="margin-left:25px">Prepared By: </label>
                <label id="label2"><?php echo $preparedfullname; ?></label>
                <input type="text" name="preparedBY" value="<?php echo $preparedfullname; ?>" hidden/>
                <br><br>
                <label id="label" style="margin-left:25px">Pullout by:</label>
                <label id="label2"><?php echo $pulloutfullname ; ?></label>
                 <input type="text" name="pulloutBY" value="<?php echo $pulloutfullname ; ?>" hidden/>
                  <br><br>
               
                <label id="label" style="margin-left:25px">Date:</label>
                <label id="label2" style="margin-left:39px"><?php echo $pulldate=date("F j, Y");?></label>
                <br><br>
                 <label id="label" style="margin-left:550px">Acknowledge By:</label>
                <label id="label2">________________________________</label>
               <br>
                <label id="label2" style="margin-left:700px">Printed Name & Signature</label>
                <br><br>  <br><br>
           <!--     <label id="label" style="margin-left:50px">Time:</label>
                <label id="label2" ></label> -->

         <!--        <form method="post" action="pulloutPDF.php?id=<?php //echo $id ?>">  -->
         		<input type="image" src="images/print.png" width="300" height="300" value="print" name="submit1" id="submit">
                 <input type="text" name="svnumber" value="<?php echo $id ?>" hidden/>
                 <input type="text" name="log" value="<?php echo $log ?>" hidden/>



                 </form>
                        </div>
        	</div>
             </div>
<br>
<center><font face="century gothic" size="-1"<p>AtomIT Solutions &copy;  All rights reserved 2014.mpz</p></center>
<br>
</div>
</body>
</html>