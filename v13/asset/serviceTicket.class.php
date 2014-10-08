<?php

class serviceTicket {

    private $messageHTMLFormat;

    public function GenerateWorkOrderNumber(){
        //generate random num
        $work_number = rand(1,999999);

        $query = "SELECT work_number FROM wo_ticket_details WHERE work_number ";

        $result = DB::getInstance()->query($query);

        if($result->rowCount()){

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                //gernerate again if found is already exist
                $work_number = rand(1,999999);
            }

        }

        return $work_number;

    }

    public function createWorkOrder($log,$assignToEngineer, $duedate, $duetime , $priority, $messageToEngineer, $sv_number){

        if(isset($sv_number) && isset($assignToEngineer)){

            $wo_number = $this->GenerateWorkOrderNumber();

            $subject = "Service Ticket Notification";
            $headers  = "From: $assignToEngineer\r\n";
            $headers .= "Content-type: text/html\r\n";
            //options to send to cc+bcc
            ////$headers .= "Cc: [email]maa@p-i-s.cXom[/email]";
            // //$headers .= "Bcc: [email]email@maaking.cXom[/email]";
            $message = $this->messageFormatFuction($sv_number, $wo_number, $assignToEngineer,$log);

            $SQLCreateWorkOrderPrepare = "";

            $isSuccess = false;

            $db = DB::getInstance();
			$db->mBeginTransaction();
    
            try{


                //First Query
                $CreateWorkOrderPrepare = $db->prepare("INSERT INTO wo_ticket_details (
log_No,sv_number,  assignToEngineer,  work_number, MessagetoEngineer, created,
 status, priority, duedate, response, duetime, time_created, wo_date_created, isOverdue)
                                                            VALUES ( :log, :sv_number, :engineer, :work_number, :MessagetoEngineer, NOW(),
                                                            1, :priority, :duedate, 0, :duetime, NOW(), NOW(), 0)");

                $CreateWorkOrderPrepare->execute(array(
                                                                                                        ':log' => $log,
																										':sv_number' => $sv_number,
                                                                                                        ':engineer' => $assignToEngineer,
                                                                                                        ':priority' => $priority,
                                                                                                        ':duedate' => $duedate,
                                                                                                        ':duetime' => $duetime,
                                                                                                        ':work_number' =>$wo_number,
                                                                                                        ':MessagetoEngineer' =>$messageToEngineer
                                                                                                        )
                                                                                    );
																					
																					
			$UpdateToTicketStatus = DB::getInstance()->prepare("UPDATE ticket_status
			     SET dateWorkOderCreated=now(),WorkOderNo=?,isWOOpen=1,dateWOCreated=now()
				 WHERE ticketNo = ? AND log_ID = ?");																		
			$UpdateToTicketStatus->execute(array($wo_number,$sv_number,$log,));
				
																					
			$db->mCommit();																		

                //If First Query was not executed successful add it the exception
                if($CreateWorkOrderPrepare->rowCount() < 1){
                        throw new Exception("Failed to Inset Work order");
                        $isSuccess = false;
                }


                //Second Query
                $UpdateTicketisAssign = $db->prepare("UPDATE sv_ticket_header SET isAssign = 1 WHERE sv_number =?");
                $UpdateTicketisAssign->execute(array($sv_number));


                //If Second Query was not executed successful add it the exception
                if($UpdateTicketisAssign->rowCount() < 1 ){
                        throw new Exception("Failed to update ticket is Assign");
                        $isSuccess = false;
                }

                if($CreateWorkOrderPrepare){
                    //Email the user
                    mail($assignToEngineer, $subject, $message, $headers);
                    //Redirect::to( 5, "createworkorder.php?id=".$sv_number."");
					Redirect::to( 5, "myassignticket.php");
                }



                $isSuccess = true;
		
				

            }catch (ExceptionException $e){
                $db->mRollBack();
                echo "Unexpected Error" .$e->getMessage();
                $isSuccess = false;
				        	 
            }

   

            return $isSuccess;

        }else{
            return false;
        }

    }


    private function messageFormatFuction($sv_number, $wo_number ,$assignToEngineer,$log){

        return $this->messageHTMLFormat = '

        <html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title></title>
</head>
<body style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; fontsize:12px; margin:0; padding:0;">
<div style="background:#F6F6F6; font-family:Verdana, Arial, Helvetica, sans-serif; fontsize:12px; margin:0; padding:0;">
<table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%">
<tr>
<td align="center" valign="top" style="padding:20px 0 20px 0">
<table bgcolor="#FFFFFF" cellspacing="0" cellpadding="10" border="0" width="700" style="border:1px solid #093f56;">
<!-- Header -->
<tr>
<td bgcolor="#FFFFFF" valign="top">
<a href="http://steadfast.com"}}"><img src="steadfast.jpg" width="auto"  height="90" style="margin-bottom:10px; margin-right:5px;" border="0"/></a>
</td>
</tr>
<!-- Body -->
<tr>
<td valign="top">
<h1 style="font-size:20px; font-weight:normal; line-height:22px; margin:0 0 11px 0;>  Hello, [{ORDER.CFULLNAME}] </h1>
</td>
</tr>
<tr><td>
<h2 style="font-size:16px; font-weight:normal; margin:0;"> </h2>

</td></tr>
<tr><td>
<table cellspacing="0" cellpadding="0" border="0" width="100%">

<thead>
<tr>
<th align="left" width="325" bgcolor="#EAEAEA" style="fontsize:13px; padding:5px 9px 6px 9px; line-height:1em;">Service Ticket Notification</th>
<th width="auto"></th>
</tr>
</thead>
<tbody>
<tr>
<td>&nbsp;</td>
</tr>
</tbody>

</table>
<!--Details -->
<div><center>
     <p>Dear '.$assignToEngineer.', </p>
                <br />
            <p>Ticket created click the link to show details.</p>
            <br />
                                        <a href="http://steadfast.net76.net/steadfast/workorder?id='. $sv_number.'&&log='.$log.'">http://steadfast.net76.net/steadfast/workorder?id='. $wo_number.'</a>

                <br />
 </center>  </div>


<table cellspacing="0" cellpadding="0" border="0" width="100%"></table>
<!-- Footer -->
<tr>

<td bgcolor="#EAEAEA" align="center" style="background:##C0C0C0; textalign:center;"> <center>

<p style="font-size:12px; margin:0;"><strong>Need help? Visit the <a href="http://atomitsoln.com" target="_blank">Help center</strong></a>.</p>

<p style="font-size:12px; margin:0;"> To learn more about SteadFast, visit the <a href="" target="_blank">Our Website</a>.</p>

<p style="font-size:12px; margin:0;">&copy 2014 SteadFast  All Rights Reserved.</p>
</center> </td>
 </tr>
</table></table>
</div>
</body>
</html>';

    }

} 