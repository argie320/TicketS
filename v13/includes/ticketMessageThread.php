<?php 

$sql = "SELECT * FROM wo_ticket_details_replay
 INNER JOIN wo_ticket_details ON  wo_ticket_details.work_number = wo_ticket_details_replay.work_number
WHERE  wo_ticket_details_replay.work_number";

$ticketThreadMessage = DB::getInstance()->query($sql);
$TickethreadHTML = "";
if($ticketThreadMessage->rowCount() > 0){

    while($row = $ticketThreadMessage->fetch(PDO::FETCH_ASSOC)){
        $from =  $row['sender'];
        $message = $row['message'];
        $reciever  = $row['reciever'];
        $DateResponse =  $row['DateResponse'];
        $sv_number = $row['sv_number'];
        $work_number = $row['work_number'];

        $TickethreadHTML .= '<tr>
                    	<td width="650px">
                        	<label id="label">From:</label>
                            <label id="label2">'.$from.'</label>
                        </td>
                        <td>
                        	<label id="label">Date Response:</label>
                            <label id="label2">'. $DateResponse.'</label>
                        </td>
                    </tr>
                   <tr>
                    	<td style="border: 1px solid #667; border-top:#FFF; border-right:#FFF">
                       		<label id="label2">
                       			message:
                            </label>
                            <label id="label">'.$message.'</label>
                        </td>
                    </tr>';

    }

}


?>

<table id="thread" style="margin-bottom:30px">
     <!-- START REPLY OF ENGR -->
   <?php echo $TickethreadHTML; ?>
                     
 </table>