<?php

include ("init.php");

$details="";

/* $emailqry = DB::getinstance()->prepare("SELECT * FROM sv_ticket_header
                                 INNER JOIN wo_ticket_details
                                        ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                 INNER JOIN sv_ticket_details
                                        ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
								 INNER JOIN ticket_status
								        ON sv_ticket_header.log_ID=ticket_status.log_ID 		
                                 INNER JOIN gagamit
								        ON wo_ticket_details.assignToEngineer = gagamit.email
							      WHERE sv_ticket_header.date_created < now()"); */
								  
 $emailqry = DB::getinstance()->prepare("SELECT * FROM sv_ticket_header
                                 INNER JOIN wo_ticket_details
                                        ON sv_ticket_header.log_ID=wo_ticket_details.log_No
                                 INNER JOIN sv_ticket_details
                                        ON sv_ticket_header.log_ID=sv_ticket_details.log_ID
								 INNER JOIN ticket_status
								        ON sv_ticket_header.log_ID=ticket_status.log_ID 		
                                 INNER JOIN gagamit
								        ON wo_ticket_details.assignToEngineer = gagamit.email
							      WHERE sv_ticket_header.date_created < now()"); 							  
								  
$emailqry->execute();										

if($emailqry->rowCount()){

      while($row = $emailqry->fetch(PDO::FETCH_ASSOC)){
		  
		  $sv_number = $row['sv_number'];
		  $fullname = $row['fullname'];
		  $log = $row['log_ID'];
		  $wo_number = $row['work_number'];
		  $to = $row['assignToEngineer'];
		
		
			  $details .='
	       <table style="margin-left:auto; margin-right:auto;">
		       <tr>
			   <th>'.$sv_number.'</th>
 		      </tr>
		  </table>
	  ';
		  
	  }
	  
}




echo $details;


$subject = "Service Ticket Notification";
$headers  = "From: $fullname , $to \r\n";
$headers .= "Content-type: text/html\r\n";

$message = '
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
<a href="http://steadfast.com"}}"><img src="images/logo_steadfast.jpg" width="auto"  height="90" style="margin-bottom:10px; margin-right:5px;" border="0"/></a>
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
     <p>Dear '.$fullname.', </p>
                <br />
            <p>Workorder created click the link to show details.</p>
            <br />
                                        <a href="http://steadfast.net76.net/steadfast/workorder?id='. $sv_number.'&&log='.$log.'">http://steadfast.net76.net/steadfast/workorder?id='. $wo_number.'</a>
										
                                        <a href="http://localhost/v12/workorder?id='. $sv_number.'&&log='.$log.'">http://steadfast.net76.net/steadfast/workorder?id='. $wo_number.'</a>										

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


mail($to, $subject, $message, $headers);

echo $message;

?>